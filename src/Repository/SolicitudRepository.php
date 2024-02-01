<?php

namespace App\Repository;

use App\Entity\Solicitud;
use App\Entity\SolicitudAplicacion;
use App\Entity\Usuario;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class SolicitudRepository extends ServiceEntityRepository
{

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Solicitud::class);
    }

    public function pendiente()
    {
        $em = $this->getEntityManager();
        $queryBuilder = $em->createQueryBuilder()->from(Solicitud::class, 's')
            ->select('s.id')
            ->addSelect('s.fecha')
            ->addSelect('s.descripcion')
            ->addSelect('s.usuarioId')
            ->where("s.estadoAsignado = false");
        $arSolicitudes = $queryBuilder->getQuery()->getResult();
        return [
            'error' => false,
            'respuesta' => [
                'solicitudes' => $arSolicitudes
            ]
        ];
    }

    public function aplicar($codigoUsuario, $codigoSolicitud)
    {
        $em = $this->getEntityManager();
        $arUsuario = $em->getRepository(Usuario::class)->find($codigoUsuario);
        if($arUsuario) {
            $arSolicitud = $em->getRepository(Solicitud::class)->find($codigoSolicitud);
            if($arSolicitud) {
                $arSolicitudAplicacion = $em->getRepository(SolicitudAplicacion::class)->findOneBy(['solicitudId' => $codigoSolicitud, 'usuarioId' => $codigoUsuario]);
                if(!$arSolicitudAplicacion) {
                    $arSolicitudAplicacion = new SolicitudAplicacion();
                    $arSolicitudAplicacion->setFecha(new \DateTime('now'));
                    $arSolicitudAplicacion->setUsuario($arUsuario);
                    $arSolicitudAplicacion->setSolicitud($arSolicitud);
                    $em->persist($arSolicitudAplicacion);
                    $em->flush();
                    return [
                        'error' => false,
                        'respuesta' => [
                            'mensaje' => 'Aplico correctamente a la solicitud'
                        ]
                    ];
                } else {
                    return [
                        'error' => true,
                        'errorMensaje' => "Este usuario ya aplico a esta solicitud"
                    ];
                }
            } else {
                return [
                    'error' => true,
                    'errorMensaje' => "No existe la solicitud"
                ];
            }
        } else {
            return [
                'error' => true,
                'errorMensaje' => "No existe el usuario"
            ];
        }
    }

    public function asignar($codigoUsuario, $codigoSolicitudAplicacion)
    {
        $em = $this->getEntityManager();
        $arUsuario = $em->getRepository(Usuario::class)->find($codigoUsuario);
        if($arUsuario) {
            $arSolicitudAplicacion = $em->getRepository(SolicitudAplicacion::class)->find($codigoSolicitudAplicacion);
            if($arSolicitudAplicacion) {
                if($arSolicitudAplicacion->isEstadoAsignado() == false) {
                    $arSolicitudAplicacion->setEstadoAsignado(true);
                    $em->persist($arSolicitudAplicacion);
                    $arSolicitud = $em->getRepository(Solicitud::class)->find($arSolicitudAplicacion->getSolicitudId());
                    $arSolicitud->setEstadoAsignado(true);
                    $arSolicitud->setUsuarioAsignado($arSolicitudAplicacion->getUsuario());
                    $em->persist($arSolicitud);
                    $em->flush();
                    return [
                        'error' => false,
                        'respuesta' => [
                            'mensaje' => 'Se asigno correctamente la solicitud'
                        ]
                    ];
                } else {
                    return [
                        'error' => true,
                        'errorMensaje' => "Esta solicitud aplicacion ya fue asignada"
                    ];
                }
            } else {
                return [
                    'error' => true,
                    'errorMensaje' => "No existe la solicitud aplicacion"
                ];
            }
        } else {
            return [
                'error' => true,
                'errorMensaje' => "No existe el usuario"
            ];
        }
    }

}
