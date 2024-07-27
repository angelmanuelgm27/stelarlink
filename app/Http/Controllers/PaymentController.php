<?php

namespace App\Http\Controllers;

use App\Models\File;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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

        $validated = $request->validate([
            'amount_bs' => ['required', 'decimal:0,2', 'min:1'],
            'amount_dollar' => ['required', 'decimal:0,2', 'min:1'],
            'reference' => ['required', 'string', 'max:255'],
            'image' => ['required', 'file', 'mimes:bmp,gif,jpeg,jpg,png', 'max:12800'],
        ]);

        $user = Auth::user();

        $payment = $user->payments()->create([
            'amount_bs' => $validated['amount_bs'],
            'amount_dollar' => $validated['amount_dollar'],
            'reference' => $validated['reference'],
        ]);

        $file_request = $request->file('image');
        $path = Storage::disk('public')->put('/payments', $file_request);

        $file = new File();
        $file->path = $path;
        $file->name = $file_request->getClientOriginalName();

        $payment->file()->save($file);

        $user_wallet_balance_to_be_approved = floatval($user->wallet_balance_to_be_approved) + $validated['amount_dollar'];

        $user->update([
            'wallet_balance_to_be_approved' => $user_wallet_balance_to_be_approved,
        ]);

        return redirect()->route('wallet.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(Payment $payment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Payment $payment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Payment $payment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Payment $payment)
    {
        //
    }
}
