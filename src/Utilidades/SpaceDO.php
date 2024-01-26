<?php

namespace App\Utilidades;

use SpacesAPI\Spaces;

class SpaceDO
{

    public function __construct()
    {

    }

    public function subirB64($directorio, $base64) {
        //https://github.com/SociallyDev/Spaces-API
        try {
            $nombreArchivo = bin2hex(random_bytes((30 - (20 % 2)) / 2));
            $data = explode(',', $base64);
            $datos = $data[0];
            $base64Crudo = $data[1];
            $data = explode(':', $datos);
            $data = $data[1];
            $data = explode(';', $data);
            $mimeType = $data[0];
            $data = explode('/', $mimeType);
            $extension = $data[1];
            $destinoLocal = "/var/www/html/temporal/{$nombreArchivo}.{$extension}";

            $destinoDO = "yodo/$directorio/{$nombreArchivo}.{$extension}";
            $base64Crudo = base64_decode($base64Crudo);
            file_put_contents($destinoLocal, $base64Crudo);

            $spaces = new Spaces($_ENV['DO_CLAVE_ACCESO'], $_ENV['DO_CLAVE_SECRETA'], $_ENV['DO_REGION']);
            $space = $spaces->space($_ENV['DO_BUCKET']);
            $space->uploadFile($destinoLocal, $destinoDO, $mimeType);
            unlink($destinoLocal);
            return [
                'url' => "{$destinoDO}"
            ];
        } catch (\Exception $e) {
            return  [
                'error' => true,
                'errorMensaje' => "Ocurrio un error con el Space"
            ];
        }
    }

    public function eliminar($rutaDestino, $codigoModelo) {
        try {
            $rutaDestino = "rubidio/{$codigoModelo}/{$rutaDestino}";
            $spaces = new Spaces($_ENV['DO_CLAVE_ACCESO'], $_ENV['DO_CLAVE_SECRETA'], $_ENV['DO_REGION']);
            $my_space = $spaces->space("semantica");
            $my_space->file($rutaDestino)->delete();
            return [
                'error' => false
            ];
        } catch (\Exception $e) {
            return  [
                'error' => true,
                'errorMensaje' => "Ocurrio un error con el Space"
            ];
        }
    }

    public function contenido($rutaDestino, $codigoArchivoTipo) {
        try {
            $rutaDestino = "rubidio/{$codigoArchivoTipo}/{$rutaDestino}";
            $spaces = new Spaces($_ENV['DO_CLAVE_ACCESO'], $_ENV['DO_CLAVE_SECRETA'], $_ENV['DO_REGION']);
            $my_space = $spaces->space("semantica");
            $contenido = $my_space->file($rutaDestino)->getContents();
            return [
                'error' => false,
                'contenido' => $contenido
            ];
        } catch (\Exception $e) {
            return  [
                'error' => true,
                'errorMensaje' => "Ocurrio un error con el Space"
            ];
        }
    }
}