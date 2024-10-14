<?php

namespace App\Traits\BNC;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

trait BNCApi
{


    private string $clienteGUID = 'c149ea7a-df09-475f-8159-baaa2e44e129';
    private string $Masterkey = '9d50c6b84398ba4b413a0e2d1e31acfa';

    public function LogOn()
    {

        //datos
        $cliente = json_encode(['ClientGUID' => $this->clienteGUID]);

        //value
        $value = $this->encrypt($cliente,$this->Masterkey);

        //validation
        $validation = $this->createHash($cliente);

        //solicitud
        $solicitud = array(
            'ClientGUID'=>$this->clienteGUID,
            'value'=>$value,
            'Validation'=>$validation,
            'Reference'=>'',
            'swTestOperation'=>false,
        );

        $jsonSolicitud = json_encode($solicitud);

        $gurl = 'https://servicios.bncenlinea.com:16500/Api/Auth/LogOn';
        $gResult = $this->gPost($gurl,$jsonSolicitud);
        $resultado = json_decode($gResult,true);

        $WorkingKey = $this->proSession($resultado['value'],$this->Masterkey);

        return $WorkingKey;

    }

    public function BCVRates()
    {

        $solicitud_data = array();
        $json_data = json_encode($solicitud_data);
        $Masterkey = $this->LogOn();
        $data_value = $this->encrypt($json_data, $Masterkey);
        // $data_referencia = $this->refere();
        $data_referencia = '';
        $data_validation = $this->createHash($json_data);
        $data_solicitud = array(
            'ClientGUID'=>$this->clienteGUID,
            'value'=>$data_value,
            'Validation'=>$data_validation,
            'Reference'=>$data_referencia,
            'swTestOperation'=>false,
        );
        $jsonSolicitud = json_encode($data_solicitud);

        $gurl = 'https://servicios.bncenlinea.com:16500/Api/Services/BCVRatesGet';
        $gResult = $this->gPost($gurl,$jsonSolicitud);
        $resultado = json_decode($gResult,true);
dd($resultado);
        return $resultado;

    }

    public function banksList()
    {

        $solicitud_data = array();
        $json_data = json_encode($solicitud_data);
        $Masterkey = $this->LogOn();
        $data_value = $this->encrypt($json_data, $Masterkey);
        // $data_referencia = $this->refere();
        $data_referencia = '';
        $data_validation = $this->createHash($json_data);
        $data_solicitud = array(
            'ClientGUID'=>$this->clienteGUID,
            'value'=>$data_value,
            'Validation'=>$data_validation,
            'Reference'=>$data_referencia,
            'swTestOperation'=>false,
        );
        $jsonSolicitud = json_encode($data_solicitud);
        $gurl = 'https://servicios.bncenlinea.com:16500/Api/Services/Banks';
        $gResult = $this->gPost($gurl,$jsonSolicitud);

        $resultado = json_decode($gResult,true);
dd($resultado);
        return $resultado;

    }

    function encrypt($data,$Masterkey) {
        $method = 'aes-256-cbc';
        $sSalt = chr(0x49) . chr(0x76) . chr(0x61) . chr(0x6e) . chr(0x20) . chr(0x4d) . chr(0x65) . chr(0x64) . chr(0x76) . chr(0x65) . chr(0x64) . chr(0x65) . chr(0x76);

        $pbkdf2 = hash_pbkdf2('SHA1',$Masterkey,$sSalt ,1000,48,true);
        $key = substr($pbkdf2, 0, 32);
        $iv =  substr($pbkdf2, 32, strlen($pbkdf2));


        $string =  mb_convert_encoding($data, 'UTF-16LE', 'UTF-8');
        $encrypted = base64_encode(openssl_encrypt($string, $method, $key, OPENSSL_RAW_DATA, $iv));
        return $encrypted; //tools
    }

    function createHash($data){

        $validation = hash('sha256', utf8_encode($data));
        return $validation;

    }

    function gPost($gurl,$jsonSolicitud){

        $ch = curl_init($gurl);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonSolicitud);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            $error_msg = curl_error($ch);
dd($error_msg);
            // ***
        }
        curl_close($ch);
        return $result;

    }

    function proSession($val,$Masterkey){
        $wk = $this->decrypt($val,$Masterkey);
        $wk = json_decode($wk,true);
        $wk = $wk['WorkingKey'];
        return $wk;
    }

    function decrypt($data,$Masterkey) {
        $method = 'aes-256-cbc';
        $sSalt = chr(0x49) . chr(0x76) . chr(0x61) . chr(0x6e) . chr(0x20) . chr(0x4d) . chr(0x65) . chr(0x64) . chr(0x76) . chr(0x65) . chr(0x64) . chr(0x65) . chr(0x76);

        $pbkdf2 = hash_pbkdf2('SHA1',$Masterkey,$sSalt ,1000,48,true);
        $key = substr($pbkdf2, 0, 32);
        $iv =  substr($pbkdf2, 32, strlen($pbkdf2));

        $string = openssl_decrypt(base64_decode($data), $method, $key, OPENSSL_RAW_DATA, $iv);
        $decrypted = mb_convert_encoding($string, 'UTF-8', 'UTF-16LE');

        return $decrypted;
    }

    function refere(){
        //20220831090831
        $fecha = date('Y-m-d h:i:s', time());
        $fecha = strval($fecha);
        $fecha = str_replace('-','',$fecha);
        $fecha = str_replace(':','',$fecha);
        $fecha = str_replace(' ','',$fecha);
        $result = $fecha;
        return $result;
    }

}
