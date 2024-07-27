<?php

namespace App\Http\Controllers;

use App\Models\PaymentMethod;
use Illuminate\Http\Request;

class FundController extends Controller
{

    public function index()
    {

        $payment_methods = PaymentMethod::where('enabled', true)
            ->get();

        $data = [
            'payment_methods' => $payment_methods,
        ];

        return view('users.payment-methods', $data);

    }

    public function getPaymenMethod(PaymentMethod $paymentMethod)
    {

        return response()->json($paymentMethod);

    }

}
