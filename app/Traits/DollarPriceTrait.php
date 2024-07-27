<?php

namespace App\Traits;

trait DollarPriceTrait
{

    public function getDollarPrice()
    {


      $url = 'https://www.bcv.org.ve/';

      $ch = curl_init();
      curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
      curl_setopt($ch, CURLOPT_HEADER, 0);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      curl_setopt($ch, CURLOPT_URL, $url);
      curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
      curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 300);
      curl_setopt($ch, CURLOPT_TIMEOUT, 300); //timeout in seconds

      $html = curl_exec($ch);

      if ( curl_errno( $ch ) ) {
        return false ;
      }

      curl_close($ch);

      // error_log($html);

      $doc = new \DOMDocument();
      @$doc->loadHTML($html);

      $dollarDOM = $doc->getElementById('dolar')->textContent;

      // Replace the word 'USD' with an empty string
      $dollarDOM = str_replace('USD', '', $dollarDOM);

      // Replace tabs and spaces with a empty string
      $dollarDOM = preg_replace('/[\t\s]+/', '', $dollarDOM);

      // Replace "," with "."
      $dollarDOM = str_replace(',', '.', $dollarDOM);

      $dollar_price = floatval( $dollarDOM );

      return $dollar_price;

    }

}
