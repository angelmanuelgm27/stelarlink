<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PaymentMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PaymentMethodsController extends Controller
{

    public function index()
    {

        $payment_methods = PaymentMethod::all();

        $data = [
            'payment_methods' => $payment_methods,
        ];

        return view('admin.payment-methods', $data);
    }

    public function store(Request $request){

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

        return redirect()->route('admin.payment.methods.index');

    }

    public function destroy(PaymentMethod $payment_method){

        $payment_method->delete();

        return redirect()->route('admin.payment.methods.index');

    }

    public function availability(PaymentMethod $payment_method){

        $payment_method->update([
            'available' => !$payment_method->available,
        ]);

        return redirect()->route('admin.payment.methods.index');

    }



}
