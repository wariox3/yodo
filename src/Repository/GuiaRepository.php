<?php

namespace App\Repository;

use App\Entity\Despacho;
use App\Entity\Guia;
use App\Entity\Usuario;
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
        $codigoDespacho = $raw['codigoDespacho']?? null;
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
                    return [
                        'error' => false,
                        'respuesta' => [
                            'mensaje' => 'Guia entregada'
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
