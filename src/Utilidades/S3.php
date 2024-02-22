<?php

namespace App\Utilidades;

use Aws\S3\Exception\S3Exception;
use Aws\S3\S3Client;
use SpacesAPI\Spaces;

class S3
{

    public function __construct()
    {

    }

    public function subirB64($ruta, $base64, $contentType) {
        /*https://github.com/aws/aws-sdk-php*/
        try {
            $archivoDecodificado = base64_decode($base64);
            $tamano = strlen($archivoDecodificado);
            $s3 = new S3Client([
                'version' => 'latest',
                'region'  => $_ENV['DO_REGION'],
                'credentials' => [
                    'key'    => $_ENV['DO_CLAVE_ACCESO'],
                    'secret' => $_ENV['DO_CLAVE_SECRETA'],
                ],
                'endpoint'    => $_ENV['DO_ENDPOINT'],
                'http'        => [
                    'verify' => false,
                ],
            ]);
            $s3->putObject([
                'Bucket' => $_ENV['DO_BUCKET'],
                'Key'    => $ruta,
                'Body'   => $archivoDecodificado,
                'Metadata' => [
                    'Content-type' => $contentType,
                ],
                'ACL'    => 'public-read',

            ]);
            return  [
                'error' => false,
                'datos' => [
                    'tamano' => $tamano
                ]
            ];
        } catch (S3Exception $e) {
            echo "There was an error uploading the file.\n {$e}";
            return  [
                'error' => true,
                'errorMensaje' => "Ocurrio un error con el Space {$e}"
            ];
        }
    }

}