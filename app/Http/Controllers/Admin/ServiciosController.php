<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Str;
class ServiciosController extends Controller
{
    //
    public function index()
    {
        return view('admin.services');
    }

    public function updateStatus(Request $request, $id)
    {
        $service = Service::find($id);
        $service->status = !$service->status;
        $service->save();

        return response()->json(['success' => true, 'message' => 'Servicio actualizado correctamente'], 200);
    }

    public function store(Request $request)
    {

        try {

            if ($request->hasFile('image')) {

                $file = $request->file('image');
                $outputImage = 'images/services/';
                $fileName = 'service_' . time() . '_' . Str::uuid()->toString().'.'. $file->getClientOriginalExtension();

                $file->move(public_path($outputImage), $fileName);
                
                $newService = new Service();
                $newService->name = $request->input('service_name');
                $newService->status = $request->input('service_status');
                $newService->price = $request->input('service_price');
                $newService->velocity_download = $request->input('service_velocity_download');
                $newService->velocity_load = $request->input('service_velocity_load');
                $newService->image = $fileName;
                $newService->save();
                return redirect()->back()->with('success', 'Servicio creado correctamente');

            }

            return redirect()->back()->with('error', 'No se ha podido crear el servicio por el tipo de imagen');

        } catch (\Exception $e) {

            return redirect()->back()->with('error', $e->getMessage());

        }

    }

    public function delete($id)
    {
        $service = Service::findOrFail($id);
        $service->delete();

        return response()->json(['success' => true, 'message' => 'Servicio eliminado correctamente'], 200);
    }

    public function edit(Request $request, $id)
    {
        try {
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $outputImage = 'images/services/';
                $fileName = 'service_' . time() . '_' . Str::uuid()->toString().'.'. $file->getClientOriginalExtension();

                $file->move(public_path($outputImage), $fileName);
                
                $newService = Service::find($id);
                $newService->name = $request->input('service_name_edit');
                $newService->price = $request->input('service_price_edit');
                $newService->velocity_download = $request->input('service_velocity_download_edit');
                $newService->velocity_load = $request->input('service_velocity_load_edit');
                $newService->image = $fileName;
                $newService->save();

                return response()->json(['success' => true, 'message' => 'Servicio actualizado correctamente'], 200);
            }

            $newService = Service::find($id);
            $newService->name = $request->input('service_name_edit');
            $newService->price = $request->input('service_price_edit');
            $newService->velocity_download = $request->input('service_velocity_download_edit');
            $newService->velocity_load = $request->input('service_velocity_load_edit');
            $newService->save();
            
            return response()->json(['success' => true, 'message' => 'Servicio actualizado correctamente'], 200);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 200);
        }
    }
}
