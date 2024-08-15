<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\Payment;
use App\Models\User;
use App\Notifications\NewPaymentToConfirm;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Gate;

class PaymentController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        if (! (Gate::allows('administrador') || Gate::allows('cobranzas'))) {
            abort(403);
        }

        $payments = Payment::leftJoin('users', 'user_id', '=', 'users.id')
            ->leftJoin('payment_methods', 'payment_method_id', '=', 'payment_methods.id')
            ->with('file')
            ->select(
                'payments.*',
                'users.name as user_name',
                'payment_methods.name as payment_method_name',
            );

        if ($request->has('status') && !empty($request->status)) {
            $payments = $payments->where('payments.status', $request->status);
        }

        if ($request->has('start_date') && !empty($request->start_date)) {
            $payments = $payments->whereDate('payments.created_at', '>=', $request->start_date);
        }

        if ($request->has('end_date') && !empty($request->end_date)) {
            $payments = $payments->whereDate('payments.created_at', '<=', $request->end_date);
        }

        if ($request->has('search') && !empty($request->search)) {
            $payments = $payments
                ->where('reference', 'like', '%' . $request->search . '%');
        }

        $payments = $payments->get();

        $payments->each(function ($payment) {

            $date_created_at = Carbon::createFromFormat('Y-m-d H:i:s', $payment->created_at);
            Carbon::setLocale('es');
            $formatted_created_at = $date_created_at->isoFormat('D \d\e MMMM, YYYY');

            $payment->formatted_created_at = $formatted_created_at;

        });

        $data = [
            'payments' => $payments,
            'request' => $request,
            'statuses' => Payment::$statuses,
        ];

        return view('admin.payment-index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        if (! (Gate::allows('administrador') || Gate::allows('cobranzas'))) {
            abort(403);
        }

        $validated = $request->validate([
            'amount_bs' => ['required', 'decimal:0,2', 'min:1'],
            'amount_dollar' => ['required', 'decimal:0,2', 'min:1'],
            'reference' => ['required', 'string', 'max:255'],
            'payment_method_id' => ['required', 'integer', 'exists:payment_methods,id'],
            'image' => ['required', 'file', 'mimes:bmp,gif,jpeg,jpg,png', 'max:12800'],
        ]);

        $user = Auth::user();

        $dollar_price = floatval(DB::table('options')->where('option', 'dollar_price')->value('value'));

        $payment = $user->payments()->create([
            'amount_bs' => $validated['amount_bs'],
            'amount_dollar' => $validated['amount_dollar'],
            'reference' => $validated['reference'],
            'payment_method_id' => $validated['payment_method_id'],
            'dollar_price' => $dollar_price,
        ]);

        $file_request = $request->file('image');
        $path = Storage::disk('local')->put('/payments', $file_request);

        $file = new File();
        $file->path = $path;
        $file->name = $file_request->getClientOriginalName();
        $file->user_id = $user->id;
        $payment->file()->save($file);

        $user_wallet_balance_to_be_approved = floatval($user->wallet_balance_to_be_approved) + $validated['amount_dollar'];

        $user->update([
            'wallet_balance_to_be_approved' => $user_wallet_balance_to_be_approved,
        ]);

        $cobranzas_users = User::where('rol', 'cobranzas')->get();
        Notification::send($cobranzas_users, new NewPaymentToConfirm($payment));

        return redirect()->route('wallet.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(Payment $payment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Payment $payment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Payment $payment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Payment $payment)
    {
        //
    }

    public function approve(Payment $payment)
    {

        if (! (Gate::allows('administrador') || Gate::allows('cobranzas'))) {
            abort(403);
        }

        $current_user = Auth::user();

        $user = $payment->client;

        $amount_dollar = floatval($payment->amount_dollar);

        $user_wallet_balance_to_be_approved = floatval($user->wallet_balance_to_be_approved) - $amount_dollar; // minimun 0 ***
        $user_wallet_balance = floatval($user->wallet_balance) + $amount_dollar;

        $user->update([
            'wallet_balance_to_be_approved' => $user_wallet_balance_to_be_approved,
            'wallet_balance' => $user_wallet_balance,
        ]);

        $payment->update([
            'status' => 'Completado',
            'user_id_approve' => $current_user->id,
        ]);

        $plans_to_suspend = $user->plans()->where('status', 'Por suspender')->with(['service'])->get();

        foreach ($plans_to_suspend as $plan) {

            $price = $plan->service->price;
            $user_wallet_balance = floatval($user->wallet_balance);

            if($user_wallet_balance >= $price){

                $user->update([
                    'wallet_balance' => $user_wallet_balance - $price,
                ]);

                $plan->update([
                    'status' => 'Activo',
                    'renovation_date' => Carbon::now()->addMonthsNoOverflow(1),
                ]);
            }
        }

        $suspended_plans = $user->plans()->where('status', 'Suspendido')->with(['service'])->get();

        foreach ($suspended_plans as $plan) {

            $price = $plan->service->price;
            $user_wallet_balance = floatval($user->wallet_balance);

            if($user_wallet_balance >= $price){

                $user->update([
                    'wallet_balance' => $user_wallet_balance - $price,
                ]);

                $plan->update([
                    'status' => 'Por activar',
                ]);

            }

        }

        return redirect()->back();

    }

    public function reject(Payment $payment)
    {

        if (! (Gate::allows('administrador') || Gate::allows('cobranzas'))) {
            abort(403);
        }

        $user = $payment->client;

        $amount_dollar = floatval($payment->amount_dollar);

        $user_wallet_balance_to_be_approved = floatval($user->wallet_balance_to_be_approved) - $amount_dollar; // minimun 0 ***

        $user->update([
            'wallet_balance_to_be_approved' => $user_wallet_balance_to_be_approved,
        ]);

        $payment->update(['status' => 'Rechazado']);

        return redirect()->back();

    }

}
