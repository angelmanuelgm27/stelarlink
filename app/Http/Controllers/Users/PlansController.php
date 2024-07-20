<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Models\ClientServices;
use App\Models\File;
use App\Models\Invoice;
use App\Models\Payments;
use App\Models\Services;
use App\Models\Solicitudes;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Str;

class PlansController extends Controller
{
    //
    public function index()
    {

        $user_id = Auth::user()->id;

        $services = Solicitudes::where('solicitudes.user_id', $user_id)
            ->join('services', 'service_id', '=', 'services.id')
            ->select(
                'solicitudes.*',
                'services.name',
                'services.price',
                'services.velocity_load',
                'services.velocity_download',
            )
            ->get();

        $services->each(function ($service) {

            $date = Carbon::createFromFormat('Y-m-d H:i:s', $service->created_at);
            Carbon::setLocale('es');
            $formatted_created_at = $date->isoFormat('D \d\e MMMM, YYYY');

            $service->formatted_created_at = $formatted_created_at;

            $time_now = Carbon::now();
            $total_duration_in_hours = $time_now->diffInHours($service->updated_at);
            if($total_duration_in_hours > 12 && $service->status == 'Pendiente' ){
                $service->action = 'Cancelar'; // ***
            }


        });

        return view('users.plans', ['services' => $services]);
    }

    public function store(Request $request)
    {

        $user = Auth::user();
        $user_id = $user->id;

        try {

            if ($request->file('image')) {
                $payment_file = $request->file('image');
                $outputImage = 'images/payments/';
                $fileName = 'payment_' . time() . '_' . Str::uuid()->toString();

                $plan = Services::where('id', $request->input('plan_id'))->get();
                if (count($plan) > 0) {

                    $paymentUrl = '/storage/' . $outputImage . $fileName . '.' . $payment_file->getClientOriginalExtension();

                    $lastIdPayment = Payments::latest()->first();
                    if ($lastIdPayment == null) {
                        $newIdPayment = 1;
                    } else {
                        $newIdPayment = $lastIdPayment->id + 1;
                    }

                    $payment = new Payments;
                    $payment->id = $newIdPayment;
                    $payment->user_id = $user_id;
                    $payment->service_id = $plan[0]->id;
                    $payment->status = "Pendiente";
                    $payment->reference = $request->input('payment_ref');
                    $payment->imagen = $paymentUrl;
                    $payment->save();

                    $pdf_data = [
                        'plan_price' => $plan[0]->price,
                        'plan_name' => $plan[0]->name,
                        'user_name' => $user->name,
                    ];
                    $file_name = '/invoices/Factura-' . $newIdPayment . '.pdf';
                    $file_path = storage_path('app') . $file_name;
                    $invoice_file = Pdf::loadView('pdf.service-invoice', $pdf_data)->save($file_path);

                    $invoices = new Invoice;
                    $invoices->user_id = $user_id;
                    $invoices->service_id = $plan[0]->id;
                    $invoices->amount = $plan[0]->price;
                    $invoices->id_payment = $newIdPayment;
                    $invoices->save();

                    $file = new File();
                    $file->path = $file_path;
                    $file->name = $file_name;
                    $invoices->file()->save($file);

                    $clientServices = new ClientServices;
                    $clientServices->user_id = $user_id;
                    $clientServices->service_id = $plan[0]->id;
                    $clientServices->save();

                    $solicitude = new Solicitudes;
                    $solicitude->user_id = $user_id;
                    $solicitude->service_id = $plan[0]->id;
                    $solicitude->invoice_id = $invoices->id;
                    $solicitude->status = "Pendiente";
                    $solicitude->save();

                    $payment_file->storeAs($outputImage, $fileName . '.' . $payment_file->getClientOriginalExtension(), 'public');
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
        $clientServices = ClientServices::where('user_id', Auth::user()->id)->get();
        foreach ($clientServices as $clientService) {
            $service = Services::find($clientService->service_id);
            array_push($data, $service);
        }
        return response()->json(['success' => true, 'data' => $data]);
    }

    public function cancel(Solicitudes $solicitudes){

        // ***

        $solicitudes->update(['status' => 'Cancelada']);

        return redirect()->route('client.plans');

    }

}
