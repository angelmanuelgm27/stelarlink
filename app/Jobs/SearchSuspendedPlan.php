<?php

namespace App\Jobs;

use App\Models\Plan;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Carbon;

class SearchSuspendedPlan implements ShouldQueue
{

    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {

        $plans = Plan::where('renovation_date', '<=', Carbon::now()->subDay())
            ->where('status', 'Activo')
            ->get();

        $plans->each(function ($plan) {

            $user = $plan->user;
            $user_wallet_balance = $user->wallet_balance;

            $service = $plan->service;
            $service_price = $service->price;

            if($user_wallet_balance >= $service_price){

                $user_wallet_balance -= $service_price;

                $user->update([
                    'wallet_balance' => $user_wallet_balance,
                ]);

                $plan->update([
                    'renovation_date' => Carbon::now()->addMonthsNoOverflow(1),
                ]);

                // enviar notificacion ***

            }else{

                $plan->update([
                    'status' => 'Por suspender',
                ]);

                // enviar notificaciones ***

            }

        });

    }

}
