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
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class PlansController extends Controller
{
    //
    public function index()
    {

        $user_id = Auth::user()->id;

        $services = Solicitudes::where('solicitudes.id_cliente', $user_id)
            ->join('services', 'id_service', '=', 'services.id')
            ->join('invoices', 'invoice_id', '=', 'invoices.id')
            ->select(
                'solicitudes.*',
                'services.name',
                'services.price',
                'services.velocity_load',
                'services.velocity_download',
                'invoices.invoice_url'
            )
            ->get();

        $services->each(function ($service) {

            $date = Carbon::createFromFormat('Y-m-d H:i:s', $service->created_at);
            Carbon::setLocale('es');
            $formatted_created_at = $date->isoFormat('D \d\e MMMM, YYYY');

            $service->formatted_created_at = $formatted_created_at;

            $time_now = Carbon::now();
            $total_duration_in_hours = $time_now->diffInHours($service->updated_at);
            if($total_duration_in_hours < 12 && $service->status == 'Pendiente' ){
                $service->action = 'Cancelar';
            }

        });

// dd($services);

        return view('users.plans', ['services' => $services]);
    }

    public function store(Request $request)
    {

        try {

            $user = Auth::user();
            $user_id = $user->id;

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
                    $payment->id_cliente = $user_id;
                    $payment->id_service = $plan[0]->id;
                    $payment->status = "Pendiente";
                    $payment->reference = $request->input('payment_ref');
                    $payment->imagen = $paymentUrl;
                    $payment->save();

                    $pdf_data = [
                        'plan_price' => $plan[0]->price,
                        'plan_name' => $plan[0]->name,
                        'user_name' => $user->name,
                    ];

                    $pdf_file_name = 'Factura-' . $newIdPayment . '.pdf';

                    $pdf_path = storage_path('app/public/invoices/') . $pdf_file_name;

                    $pdf = Pdf::loadView('pdf.service-invoice', $pdf_data)
                        ->save($pdf_path);

                    $invoices = new Invoices;
                    $invoices->id_cliente = $user_id;
                    $invoices->id_service = $plan[0]->id;
                    $invoices->amount = $plan[0]->price;
                    $invoices->id_payment = $newIdPayment;
                    $invoices->invoice_url = '/storage/invoices/' . $pdf_file_name;
                    $invoices->save();

                    $clientServices = new ClientServices;
                    $clientServices->id_cliente = $user_id;
                    $clientServices->id_service = $plan[0]->id;
                    $clientServices->save();

                    $solicitude = new Solicitudes;
                    $solicitude->id_cliente = $user_id;
                    $solicitude->id_service = $plan[0]->id;
                    $solicitude->invoice_id = $invoices->id;
                    $solicitude->status = "Pendiente";
                    $solicitude->save();

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
