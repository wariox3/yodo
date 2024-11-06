<?php

namespace App\Utilidades;

class Zinc
{
    private $urlBase = "http://zinc.semantica.com.co";

    public function __construct(){

    }

    public function correoHtml($datos) {
        $respuesta = $this->consumoPost("/api/correo/html", $datos);
        return $respuesta;
    }
    private function consumoPost($url, $datos) {
        $urlCompleta = $this->urlBase . $url;
        $datosJson = json_encode($datos);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $urlCompleta);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $datosJson);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($datosJson))
        );
        $respuesta = curl_exec($ch);
        curl_close($ch);
        $respuesta = json_decode($respuesta, true);
        return $respuesta;
    }
}