<?php

namespace estoque\Http\Controllers;

use Illuminate\Http\Request;

class AssinaturaController extends Controller {

    
    public function assinar($url, $key, $body=null){

        $parsedUrl = parse_url($url);

        $signatureElements = $parsedUrl['path']."?".$parsedUrl['query'];

        if($body)
            $signatureElements .= $body;

        $usablePrivateKey = $key;

        $usablePrivateKey = str_replace("-","+", $usablePrivateKey);
        $usablePrivateKey = str_replace("_","/", $usablePrivateKey);


        $usablePrivateKey = base64_decode($usablePrivateKey);
        $signatureElements = utf8_encode($signatureElements);


        $assinaturaSHA1 = hash_hmac('sha1', $signatureElements, $usablePrivateKey, true);

        $assinaturaSHA1 = base64_encode($assinaturaSHA1);

        $assinaturaSHA1 = str_replace("+","-", $assinaturaSHA1);
        $assinaturaSHA1 = str_replace("/","_", $assinaturaSHA1);

        return "$url&signature=$assinaturaSHA1";

    }

    public function consultarUrl($url){

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $url
        ));

        return curl_exec($curl);
    }

    public function criar(){

        static $applicationCode = "grupotoniato";
        static $chaveDeAcesso = "zD3Bc09AbCFpyxSiNGKiNXyiNJUkOlUkOXojOJolNt==";

        $busca = "waypoint.0.latlng=-23.6,-46.7&waypoint.1.latlng=-22.9,-43.2&result=summary.tolls&avoid.traffic=true&travel.vehicle=TruckWithTwoDoubleAxles";

        $url_base = "https://api.maplink.com.br/v1/route?";
        // $busca = urlencode($busca);
        // $busca = "Rodovia%20Dom%20Pedro,%20km%2062";
        $url_appCode = "&applicationCode=$applicationCode";

        $url = $url_base.$busca.$url_appCode;

        $urlAssinada = $this->assinar(
            $url, $chaveDeAcesso
        );

        return $this->consultarUrl($urlAssinada);

    }


}
