<?php

namespace App\Http\Controllers;

use App\Models\PaymentMethod;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class FundController extends Controller
{

    public function index()
    {

        if (! (Gate::allows('default'))) {
            abort(403);
        }

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

        if (! (Gate::allows('default'))) {
            abort(403);
        }

        return response()->json($paymentMethod);

    }

}
