<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\File;
use App\Models\Invoice;
use App\Models\Service;
use App\Models\Plan;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Session;

class UserServiceController extends Controller
{

    public function index()
    {

        $user = Auth::user();
        $user_id = $user->id;

        $user_requests = Plan::where('plans.user_id', $user_id)
            ->with(['service'])
            // ->with(['service' => function ($query) {
            //     $query->select('name');
            // }])
            ->get();

        $user_requests->each(function ($user_request) {

            $date_created_at = Carbon::createFromFormat('Y-m-d H:i:s', $user_request->created_at);
            Carbon::setLocale('es');
            $formatted_created_at = $date_created_at->isoFormat('D \d\e MMMM, YYYY');

            $user_request->formatted_created_at = $formatted_created_at;

            if($user_request->instalation_date){

                $date_instalation_date = Carbon::createFromFormat('Y-m-d H:i:s', $user_request->instalation_date);
                Carbon::setLocale('es');
                $formatted_instalation_date = $date_instalation_date->isoFormat('D \d\e MMMM, YYYY');

                $user_request->formatted_instalation_date = $formatted_instalation_date;

            }

        });

        $services = Service::all();

        $data = [
            'user_requests' => $user_requests,
            'services' => $services,
            'address' => $user->address,
        ];

        return view('users.plan', $data);

    }

    public function store(Request $request)
    {

        // ***

        $validated = $request->validate([
            'plan_id' => ['required', 'numeric', 'exists:services,id'],
            'address' => ['required', 'string', 'max:512'],
        ]);

        $user = Auth::user();
        $user_id = $user->id;

        $plan_id = $validated['plan_id'];

        $plan = Service::find($plan_id);

        $user_wallet_balance = $user->wallet_balance;
        $plan_price = $plan->price;

        if($user_wallet_balance >= $plan_price){

            $user_wallet_balance = floatval($user_wallet_balance) - $plan_price;
            $user->update(['wallet_balance' => $user_wallet_balance,]);

            // reflejar consumo ***

        }else{

            Session::flash('message', 'El saldo de tu billetera es insuficiente!');
            Session::flash('alert-class', 'alert-warning');
            return redirect()->back();

        }

        $pdf_data = [
            'plan_price' => $plan_price,
            'plan_name' => $plan->name,
            'user_name' => $user->name,
        ];

        $file_name = '/invoices/Factura.pdf';
        $file_path = storage_path('app') . $file_name;
        $invoice_file = Pdf::loadView('pdf.service-invoice', $pdf_data)->save($file_path);

        $invoices = new Invoice;
        $invoices->user_id = $user_id;
        $invoices->service_id = $plan->id;
        $invoices->amount = $plan->price;
        $invoices->save();

        // invoice pdf file
        $file = new File();
        $file->path = $file_path;
        $file->name = $file_name;
        $invoices->file()->save($file);

        $planes = new Plan;
        $planes->user_id = $user_id;
        $planes->service_id = $plan->id;
        $planes->invoice_id = $invoices->id;
        $planes->adrress = $validated['address'];
        $planes->status = "Pendiente";
        $planes->save();

        Session::flash('message', 'Solicitud creada exitosamente! Pronto te contactaremos.');
        Session::flash('alert-class', 'alert-success');

        return redirect()->back();

    }

}
