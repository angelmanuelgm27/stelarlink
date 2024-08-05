<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class GetDollarPrice implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tires = 3;
    public $backoff = 300;

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

      $url = 'https://www.bcv.org.ve/';

      $ch = curl_init();
      curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
      curl_setopt($ch, CURLOPT_HEADER, 0);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt($ch, CURLOPT_URL, $url);
      curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
      curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 60);
      curl_setopt($ch, CURLOPT_TIMEOUT, 60); //timeout in seconds

      $html = curl_exec($ch);

      if ( curl_errno( $ch ) ) {
        return; // send email to notify ***
      }

      curl_close($ch);

      $doc = new \DOMDocument();
      @$doc->loadHTML($html);

      $dollarDOM = $doc->getElementById('dolar')->textContent;

      // Replace the word 'USD' with an empty string
      $dollarDOM = str_replace('USD', '', $dollarDOM);

      // Replace tabs and spaces with a empty string
      $dollarDOM = preg_replace('/[\t\s]+/', '', $dollarDOM);

      // Replace "," with "."
      $dollarDOM = str_replace(',', '.', $dollarDOM);

      $dollar_price = $dollarDOM;

      if (!empty($dollar_price) && is_numeric($dollar_price)){
        DB::table('options')->where('option', 'dollar_price')->update(['value'=> $dollar_price]);
      }else{
        return; // send email to notify ***
      }

    }
}
