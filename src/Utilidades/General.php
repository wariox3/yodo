<?php


namespace App\Utilidades;

class General
{

    public function desfragmentarArchivoBase64($base64)
    {
        $data = explode(',', $base64);
        $datos = $data[0];
        $base64Crudo = $data[1];
        $data = explode(':', $datos);
        $data = $data[1];
        $data = explode(';', $data);
        $mimeType = $data[0];
        $data = explode('/', $mimeType);
        $extension = $data[1];
        return [
            'base64' => $base64Crudo,
            'mimeType' => $mimeType,
            'extension' => $extension
        ];
    }

}