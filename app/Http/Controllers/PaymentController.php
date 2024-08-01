<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $payments = Payment::leftJoin('users', 'user_id', '=', 'users.id')
            ->leftJoin('payment_methods', 'payment_method_id', '=', 'payment_methods.id')
            ->select(
                'payments.*',
                'users.name as user_name',
                'payment_methods.name as payment_method_name',
            )->get();

        $data = [
            'payments' => $payments,
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

        $validated = $request->validate([
            'amount_bs' => ['required', 'decimal:0,2', 'min:1'],
            'amount_dollar' => ['required', 'decimal:0,2', 'min:1'],
            'reference' => ['required', 'string', 'max:255'],
            'payment_method_id' => ['required', 'integer', 'exists:payment_methods,id'],
            'image' => ['required', 'file', 'mimes:bmp,gif,jpeg,jpg,png', 'max:12800'],
        ]);

        $user = Auth::user();

        $payment = $user->payments()->create([
            'amount_bs' => $validated['amount_bs'],
            'amount_dollar' => $validated['amount_dollar'],
            'reference' => $validated['reference'],
            'payment_method_id' => $validated['payment_method_id'],
        ]);

        $file_request = $request->file('image');
        $path = Storage::disk('public')->put('/payments', $file_request);

        $file = new File();
        $file->path = $path;
        $file->name = $file_request->getClientOriginalName();

        $payment->file()->save($file);

        $user_wallet_balance_to_be_approved = floatval($user->wallet_balance_to_be_approved) + $validated['amount_dollar'];

        $user->update([
            'wallet_balance_to_be_approved' => $user_wallet_balance_to_be_approved,
        ]);

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

        $user = $payment->client;

        $amount_dollar = floatval($payment->amount_dollar);

        $user_wallet_balance_to_be_approved = floatval($user->wallet_balance_to_be_approved) - $amount_dollar; // minimun 0 ***
        $user_wallet_balance = floatval($user->wallet_balance) + $amount_dollar;

        $user->update([
            'wallet_balance_to_be_approved' => $user_wallet_balance_to_be_approved,
            'wallet_balance' => $user_wallet_balance,
        ]);

        $payment->update(['status' => 'Completado']);

        return redirect()->route('admin.payment.index');

    }

    public function reject(Payment $payment)
    {

        $user = $payment->client;

        $amount_dollar = floatval($payment->amount_dollar);

        $user_wallet_balance_to_be_approved = floatval($user->wallet_balance_to_be_approved) - $amount_dollar; // minimun 0 ***

        $user->update([
            'wallet_balance_to_be_approved' => $user_wallet_balance_to_be_approved,
        ]);

        $payment->update(['status' => 'Rechazado']);

        return redirect()->route('admin.payment.index');

    }
}
