<?php

namespace App\Repository;

use App\Entity\Carroceria;
use App\Entity\Ciudad;
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

    public function nuevo($raw)
    {
        $em = $this->getEntityManager();
        $id = $raw['id'] ?? null;
        $usuarioId = $raw['usuarioId']?? null;
        $ciudadOrigenId = $raw['ciudadOrigenId']?? null;
        $ciudadDestinoId = $raw['ciudadDestinoId']?? null;
        $carroceriaId = $raw['carroceriaId']?? null;
        $precio = $raw['precio']?? 0;
        $peso = $raw['peso']?? 0;
        $volumen = $raw['volumen']?? 0;
        $entregas = $raw['entregas']?? 0;
        $arUsuario = $em->getRepository(Usuario::class)->find($usuarioId);
        if($arUsuario) {
            $arCarroceria = $em->getRepository(Carroceria::class)->find($carroceriaId);
            if($arCarroceria) {
                $arCiudadOrigen = $em->getRepository(Ciudad::class)->find($ciudadOrigenId);
                if($arCiudadOrigen) {
                    $arCiudadDestino = $em->getRepository(Ciudad::class)->find($ciudadDestinoId);
                    if($arCiudadDestino) {
                        if($id) {
                            $arSolicitud = $em->getRepository(Solicitud::class)->find($id);
                        } else {
                            $arSolicitud = new Solicitud();
                        }
                        $arSolicitud->setFecha(new \DateTime('now'));
                        $arSolicitud->setUsuario($arUsuario);
                        $arSolicitud->setCarroceria($arCarroceria);
                        $arSolicitud->setCiudadOrigen($arCiudadOrigen);
                        $arSolicitud->setCiudadDestino($arCiudadDestino);
                        $arSolicitud->setPrecio($precio);
                        $arSolicitud->setPeso($peso);
                        $arSolicitud->setVolumen($volumen);
                        $arSolicitud->setEntregas($entregas);
                        $em->persist($arSolicitud);
                        $em->flush();
                        return [
                            'error' => false,
                            'respuesta' => [
                                'id' => $arSolicitud->getId(),
                            ]
                        ];
                    } else {
                        return [
                            'error' => true,
                            'errorMensaje' => "No existe la ciudad destino"
                        ];
                    }
                } else {
                    return [
                        'error' => true,
                        'errorMensaje' => "No existe la ciudad origen"
                    ];
                }
            } else {
                return [
                    'error' => true,
                    'errorMensaje' => "No existe la carroceria"
                ];
            }
        } else {
            return [
                'error' => true,
                'errorMensaje' => "No existe el usuario"
            ];
        }


    }

    public function pendiente()
    {
        $em = $this->getEntityManager();
        $queryBuilder = $em->createQueryBuilder()->from(Solicitud::class, 's')
            ->select('s.id')
            ->addSelect('s.fecha')
            ->addSelect('s.descripcion')
            ->addSelect('s.usuarioId')
            ->addSelect('s.precio')
            ->addSelect('s.peso')
            ->addSelect('s.volumen')
            ->addSelect('s.entregas')
            ->addSelect('ca.nombre as carroceriaNombre')
            ->addSelect('origen.nombre as ciudadOrigenNombre')
            ->addSelect('destino.nombre as ciudadDestinoNombre')
            ->leftJoin('s.carroceria', 'ca')
            ->leftJoin('s.ciudadOrigen', 'origen')
            ->leftJoin('s.ciudadDestino', 'destino')
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
