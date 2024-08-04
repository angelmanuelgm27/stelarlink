<?php

namespace App\Http\Controllers;

use App\Models\PaymentMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FundController extends Controller
{

    public function index()
    {

        $payment_methods = PaymentMethod::where('available', true)
            ->get();

        $dollar_price = floatval(DB::table('options')->where('option', 'dollar_price')->value('value'));

        $data = [
            'payment_methods' => $payment_methods,
            'dollar_price' => $dollar_price,
        ];

        return view('users.payment-methods', $data);

    }

    public function getPaymenMethod(PaymentMethod $paymentMethod)
    {

        return response()->json($paymentMethod);

    }

}
