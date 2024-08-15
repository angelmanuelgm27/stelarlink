<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Gate;

class WalletController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        if (! (Gate::allows('default'))) {
            abort(403);
        }

        $user = Auth::user();

        $wallet_balance = number_format($user->wallet_balance, 2);
        $wallet_balance_to_be_approved = number_format($user->wallet_balance_to_be_approved, 2);
        $payments = $user->payments()
            ->leftJoin('payment_methods', 'payment_method_id', '=', 'payment_methods.id')
            ->with('file')
            ->select(
                'payments.*',
                'payment_methods.name as payment_method_name',
            )->get();

        $payments->each(function ($payment) {

            $date_created_at = Carbon::createFromFormat('Y-m-d H:i:s', $payment->created_at);
            Carbon::setLocale('es');
            $formatted_created_at = $date_created_at->isoFormat('D \d\e MMMM, YYYY');

            $payment->formatted_created_at = $formatted_created_at;

        });

        $data = [
            'wallet_balance' => $wallet_balance,
            'wallet_balance_to_be_approved' => $wallet_balance_to_be_approved,
            'payments' => $payments,
        ];

        return view('wallet.index', $data);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
