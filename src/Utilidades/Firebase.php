<?php

namespace App\Utilidades;

class Firebase
{

    public function __construct()
    {

    }

    public function nuevaVisita($destinatario, $codigoVisita, $visitante, $cantidadPendiente) {
        $url = "https://fcm.googleapis.com/fcm/send";
        $arreglo = [
            'to' => $destinatario,
            'notification' => [
                'title' => "Tienes una nueva visita",
                'body' => "Te visita {$visitante} debes autorizar su ingreso"
            ],
            'data' => [
                'codigoVisita' => $codigoVisita,
                'rutaApp' => 'Visita',
                'cantidadPendiente' =>$cantidadPendiente
            ]
        ];
        $parametros = json_encode($arreglo);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $parametros);

        $headers = array();
        $headers[] = 'Authorization: key = ' . $_ENV['GM_CLAVE'];
        $headers[] = 'Content-Type: application/json';
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            $error =  'Error:' . curl_error($ch);
        }
        curl_close($ch);
    }

    public function nuevaEntrega($destinatario, $codigoEntrega, $tipoEntrega, $cantidadPendiente) {
        $url = "https://fcm.googleapis.com/fcm/send";
        $arreglo = [
            'to' => $destinatario,
            'notification' => [
                'title' => "Tienes una nueva entrega",
                'body' => "Te ha llegado un@ " . strtoupper($tipoEntrega) . " nuevo"
            ],
            'data' => [
                'codigoEntrega' => $codigoEntrega,
                'rutaApp' => 'Entrega',
                'cantidadPendiente' =>$cantidadPendiente
            ]
        ];
        $parametros = json_encode($arreglo);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $parametros);

        $headers = array();
        $headers[] = 'Authorization: key = ' . $_ENV['GM_CLAVE'];
        $headers[] = 'Content-Type: application/json';
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            $error =  'Error:' . curl_error($ch);
        }
        curl_close($ch);
    }

    public function publicarVotacion($destinatario) {
        if($destinatario) {
            $url = "https://fcm.googleapis.com/fcm/send";
            $arreglo = [
                'to' => $destinatario,
                'notification' => [
                    'title' => "Tienes una nueva votacion",
                    'body' => "Acaban de publicar una nueva votacion en tu panal ingresa y vota"
                ],
                'data' => [
                    'rutaApp' => 'Votacion',
                ]
            ];
            $parametros = json_encode($arreglo);
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $parametros);

            $headers = array();
            $headers[] = 'Authorization: key = ' . $_ENV['GM_CLAVE'];
            $headers[] = 'Content-Type: application/json';
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

            $result = curl_exec($ch);
            if (curl_errno($ch)) {
                $error =  'Error:' . curl_error($ch);
            }
            curl_close($ch);
        }
    }

    public function control($destinatario)
    {
        $url = "https://fcm.googleapis.com/fcm/send";
        $arreglo = [
            'to' => $destinatario,
            'notification' => [
                'title' => "Tienes un nuevo control",
                'body' => "Te ha llegado un control nuevo, debes autorizar"
            ],
            'data' => [
                'rutaApp' => 'InicioTap',
            ]
        ];
        $parametros = json_encode($arreglo);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $parametros);

        $headers = array();
        $headers[] = 'Authorization: key = ' . $_ENV['GM_CLAVE_VIGI'];
        $headers[] = 'Content-Type: application/json';
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        $result = curl_exec($ch);
        if (curl_errno($ch)) {
            $error =  'Error:' . curl_error($ch);
        }
        curl_close($ch);
    }
}