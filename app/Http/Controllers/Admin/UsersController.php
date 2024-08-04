<?php

namespace App\Http\Controllers\Admin;

use App\Events\NotificationBroadcast;
use App\Http\Controllers\Controller;
use App\Models\PaymentMethod;
use App\Models\User;
use App\Models\UsersPasswordsRenews;
use App\Notifications\Users\AsignNewPasswordDatabaselNotification;
use App\Notifications\Users\AsignNewPasswordEmailNotification;
use App\Traits\DollarPriceTrait;
use Carbon\Carbon;
use Illuminate\Contracts\Session\Session;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use stdClass;

class UsersController extends Controller
{

    use DollarPriceTrait;

    public function index(Request $request){

        $users = User::where('rol', 'default');

        if ($request->has('search') && !empty($request->search)) {

            $users = $users
                ->whereAny(['name', 'email', 'phone', 'dni'], 'like', '%' . $request->search . '%');

        }

        $users = $users->get();

        $users->each(function ($user) {

            if(empty($user->wallet_balance)){
                $user->wallet_balance = 0;
            }

            if(empty($user->wallet_balance_to_be_approved)){
                $user->wallet_balance_to_be_approved = 0;
            }

        });

        $payment_methods = PaymentMethod::select('id', 'name')->get();

        $data = [
            'users' => $users,
            'request' => $request,
            'payment_methods' => $payment_methods,
            'dollar_price' => $this->getDollarPrice(),
        ];

        return view('admin.users', $data);

    }

    public function addFunds(Request $request, User $user){

        // check if user is client ***

        $validated = $request->validate([
            'amount_bs' => ['required', 'decimal:0,2', 'min:1'],
            'amount_dollar' => ['required', 'decimal:0,2', 'min:1'],
            'reference' => ['required', 'string', 'max:255'],
            'payment_method_id' => ['required', 'integer', 'exists:payment_methods,id'],
        ]);

        $current_user = Auth::user();

        $dollar_price = $this->getDollarPrice();

        $payment = $user->payments()->create([
            'status' => 'Completado',
            'user_id_approve' => $current_user->id,
            'amount_bs' => $validated['amount_bs'],
            'amount_dollar' => $validated['amount_dollar'],
            'reference' => $validated['reference'],
            'payment_method_id' => $validated['payment_method_id'],
            'dollar_price' => $dollar_price,
        ]);

        $user_wallet_balance = floatval($user->wallet_balance) + $validated['amount_dollar'];

        $user->update([
            'wallet_balance' => $user_wallet_balance,
        ]);

        return redirect()->back();

    }

    public function withdrawFunds(Request $request, User $user){

        // check if user is client ***

        $validated = $request->validate([
            'amount_bs' => ['required', 'decimal:0,2', 'min:1'],
            'amount_dollar' => ['required', 'decimal:0,2', 'min:1'],
            'reference' => ['required', 'string', 'max:255'],
            'payment_method_id' => ['required', 'integer', 'exists:payment_methods,id'],
        ]);

        $current_user = Auth::user();

        $dollar_price = $this->getDollarPrice();

        $payment = $user->payments()->create([
            'status' => 'Completado',
            'user_id_approve' => $current_user->id,
            'amount_bs' => '-' . $validated['amount_bs'],
            'amount_dollar' => '-' . $validated['amount_dollar'],
            'reference' => $validated['reference'],
            'payment_method_id' => $validated['payment_method_id'],
            'dollar_price' => $dollar_price,
        ]);

        $user_wallet_balance = floatval($user->wallet_balance) - $validated['amount_dollar'];

        $user->update([
            'wallet_balance' => $user_wallet_balance,
        ]);

        return redirect()->back();

    }

}
