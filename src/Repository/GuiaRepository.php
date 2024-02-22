<?php

namespace App\Repository;

use App\Entity\Archivo;
use App\Entity\Despacho;
use App\Entity\Guia;
use App\Entity\Usuario;
use App\Utilidades\S3;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class GuiaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Guia::class);
    }

    public function entrega($raw)
    {
        $em = $this->getEntityManager();
        $guia = $raw['codigoGuia']?? null;
        $usuario = $raw['usuario']?? null;
        $imagenes = $raw['imagenes']?? null;
        $ubicacion  = $raw['ubicacion']?? null;
        $firma = $raw['firmarBase64']?? null;
        $recibe = $raw['recibe'] ?? null;
        $recibeParentesco = $raw['parentesco'] ?? null;
        $recibeNumeroIdentificacion = $raw['numeroIdentificacion'] ?? null;
        $recibeCelular = $raw['celular'] ?? null;
        $fechaEntrega = $raw['fechaEntrega'] ?? null;
        $arUsuario = $em->getRepository(Usuario::class)->find($usuario);
        if($arUsuario) {
            $arGuia = $em->getRepository(Guia::class)->find($guia);
            if($arGuia) {
                if(!$arGuia->isEstadoEntrega()) {
                    $arGuia->setEstadoEntrega(true);
                    //$arGuia->setFechaEntrega();
                    $em->persist($arGuia);
                    if ($imagenes) {
                        foreach ($imagenes as $imagen) {
                            $data = explode(",", $imagen['base64']);
                            $base64 = $data[1];
                            $data = explode(":", $data[0]);
                            $data = explode(";", $data[1]);
                            $contentType = $data[0];
                            $data = explode("/", $contentType);
                            $extension = $data[1];
                            $archivoDestino = rand(1000000, 9999999) . "_" . $guia . ".$extension";
                            $directorio = "yodo/guia/";
                            $s3 = new S3();
                            $respuesta = $s3->subirB64("{$directorio}{$archivoDestino}", $base64, $contentType);
                            if($respuesta['error'] == false) {
                                $datos = $respuesta['datos'];
                                $arArchivo = new Archivo();
                                $arArchivo->setArchivoTipoId(1);
                                $arArchivo->setCodigo($guia);
                                $arArchivo->setNombre($archivoDestino);
                                $arArchivo->setDirectorio($directorio);
                                $arArchivo->setContentType($contentType);
                                $arArchivo->setTamano($datos['tamano']);
                                $em->persist($arArchivo);
                            }
                        }
                    }
                    if ($firma) {
                        $data = explode(",", $firma);
                        $base64 = $data[1];
                        $data = explode(":", $data[0]);
                        $data = explode(";", $data[1]);
                        $contentType = $data[0];
                        $data = explode("/", $contentType);
                        $extension = $data[1];
                        $archivoDestino = rand(1000000, 9999999) . "_" . $guia . ".$extension";
                        $directorio = "yodo/firma/";
                        $s3 = new S3();
                        $respuesta = $s3->subirB64("{$directorio}{$archivoDestino}", $base64, $contentType);
                        if($respuesta['error'] == false) {
                            $datos = $respuesta['datos'];
                            $arArchivo = new Archivo();
                            $arArchivo->setArchivoTipoId(2);
                            $arArchivo->setCodigo($guia);
                            $arArchivo->setNombre($archivoDestino);
                            $arArchivo->setDirectorio($directorio);
                            $arArchivo->setContentType($contentType);
                            $arArchivo->setTamano($datos['tamano']);
                            $em->persist($arArchivo);
                        }
                    }
                    $em->flush();
                    return [
                        'error' => false,
                        'respuesta' => [
                            'mensaje' => "Guia entregada"
                        ]
                    ];
                } else {
                    return [
                        'error' => true,
                        'errorMensaje' => "La guia ya fue entregada con anterioridad"
                    ];
                }
            } else {
                return [
                    'error' => true,
                    'errorMensaje' => "La guia no existe"
                ];
            }
        } else {
            return [
                'error' => true,
                'errorMensaje' => "El usuario no existe"
            ];
        }

    }
}
