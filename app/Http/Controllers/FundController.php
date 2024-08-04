<?php

namespace App\Http\Controllers;

use App\Models\PaymentMethod;
use Illuminate\Http\Request;
use App\Traits\DollarPriceTrait;

class FundController extends Controller
{

    use DollarPriceTrait;

    public function index()
    {

        $payment_methods = PaymentMethod::where('available', true)
            ->get();

        $dollar_price = $this->getDollarPrice();

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
