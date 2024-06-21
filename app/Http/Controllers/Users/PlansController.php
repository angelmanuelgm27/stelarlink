<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Str;
use App\Models\Services;
use App\Models\Payments;
use App\Models\Solicitudes;
use App\Models\ClientServices;
use App\Models\Invoices;
use Illuminate\Support\Facades\Auth;

class PlansController extends Controller
{
    //
    public function index()
    {
        return view('users.plans');
    }

    public function store(Request $request)
    {
        try {
            if ($request->file('image')) {
                $file = $request->file('image');
                $outputImage = 'images/payments/';
                $fileName = 'payment_' . time() . '_' . Str::uuid()->toString();

                $plan = Services::where('id', $request->input('plan_id'))->get();
                if (count($plan) > 0) {

                    $paymentUrl = '/storage/' . $outputImage . $fileName . '.' . $file->getClientOriginalExtension();

                    $lastIdPayment = Payments::latest()->first();
                    if ($lastIdPayment == null) {
                        $newIdPayment = 1;
                    } else {
                        $newIdPayment = $lastIdPayment->id + 1;
                    }

                    $payment = new Payments;
                    $payment->id = $newIdPayment;
                    $payment->id_cliente = Auth::user()->id;
                    $payment->id_service = $plan[0]->id;
                    $payment->status = "Pendiente";
                    $payment->reference = $request->input('payment_ref');
                    $payment->imagen = $paymentUrl;
                    $payment->save();

                    $solicitude = new Solicitudes;
                    $solicitude->id_cliente = Auth::user()->id;
                    $solicitude->id_service = $plan[0]->id;
                    $solicitude->status = "Pendiente";
                    $solicitude->save();

                    $invoices = new Invoices;
                    $invoices->id_cliente = Auth::user()->id;
                    $invoices->id_service = $plan[0]->id;
                    $invoices->amount = $plan[0]->price;
                    $invoices->id_payment = $newIdPayment;
                    $invoices->imagen = $paymentUrl;
                    $invoices->save();

                    $clientServices = new ClientServices;
                    $clientServices->id_cliente = Auth::user()->id;
                    $clientServices->id_service = $plan[0]->id;
                    $clientServices->save();


                    $file->storeAs($outputImage, $fileName . '.' . $file->getClientOriginalExtension(), 'public');
                    return response()->json(['success' => true, 'message' => 'Pago realizado exitosamente']);

                } else {
                    return response()->json(['success' => false, 'message' => 'No existe este plan']);
                }
            }
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }

    public function findAll()
    {
        $data = [];
        $clientServices = ClientServices::where('id_cliente', Auth::user()->id)->get();
        foreach ($clientServices as $clientService) {
            $service = Services::find($clientService->id_service);
            array_push($data, $service);
        }
        return response()->json(['success' => true, 'data' => $data]);
    }
}
