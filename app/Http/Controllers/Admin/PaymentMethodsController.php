<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PaymentMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Session;

class PaymentMethodsController extends Controller
{

    public function index()
    {

        if (! (Gate::allows('administrador') || Gate::allows('cobranzas'))) {
            abort(403);
        }

        $payment_methods = PaymentMethod::all();

        $data = [
            'payment_methods' => $payment_methods,
        ];

        return view('admin.payment-methods', $data);
    }

    public function store(Request $request){

        if (! (Gate::allows('administrador') || Gate::allows('cobranzas'))) {
            abort(403);
        }

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'details' => ['required', 'string', 'max:255'],
            'image' => ['required', 'file', 'mimes:bmp,gif,jpeg,jpg,png', 'max:12800'],
        ]);

        $file = $request->file('image');

        $payment_method = new PaymentMethod();
        $payment_method->name = $validated['name'];
        $payment_method->details = $validated['details'];
        $payment_method->image = Storage::disk('public')->put('payment-methods', $file);;
        $payment_method->save();

        Session::flash('message', 'Método de pago agregado exitosamente.');
        Session::flash('alert-class', 'alert-success');

        return redirect()->route('admin.payment.methods.index');

    }

    public function destroy(PaymentMethod $payment_method){

        if (! (Gate::allows('administrador') || Gate::allows('cobranzas'))) {
            abort(403);
        }

        $payment_method->delete();

        Session::flash('message', 'Método de pago eliminado exitosamente.');
        Session::flash('alert-class', 'alert-success');

        return redirect()->route('admin.payment.methods.index');

    }

    public function availability(PaymentMethod $payment_method){

        if (! (Gate::allows('administrador') || Gate::allows('cobranzas'))) {
            abort(403);
        }

        $payment_method->update([
            'available' => !$payment_method->available,
        ]);

        Session::flash('message', 'Método de pago actualizado exitosamente.');
        Session::flash('alert-class', 'alert-success');

        return redirect()->route('admin.payment.methods.index');

    }



}
