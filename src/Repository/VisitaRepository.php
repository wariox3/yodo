<?php

namespace App\Repository;

use App\Entity\Celda;
use App\Entity\CeldaUsuario;
use App\Entity\Panal;
use App\Entity\Usuario;
use App\Entity\Visita;
use App\Utilidades\Firebase;
use App\Utilidades\SpaceDO;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class VisitaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Visita::class);
    }

    public function lista($codigoCelda)
    {
        $em = $this->getEntityManager();
        $queryBuilder = $em->createQueryBuilder()->from(Visita::class, 'v')
            ->select('v.id')
            ->addSelect('v.fecha')
            ->addSelect('v.numeroIdentificacion')
            ->addSelect('v.nombre')
            ->addSelect('v.placa')
            ->addSelect('v.estadoAutorizado')
            ->addSelect('v.codigoIngreso')
            ->addSelect("CONCAT('{$_ENV['ALMACENAMIENTO_URL']}', v.urlImagenIngreso) as urlImagenIngreso")
            ->where("v.celdaId = {$codigoCelda}")
            ->orderBy('v.fecha', 'DESC');
        $arVisitas = $queryBuilder->getQuery()->getResult();
        return [
            'error' => false,
            'respuesta' => [
                'visitas' => $arVisitas
            ]
        ];
    }

    public function nuevo($raw)
    {
        $em = $this->getEntityManager();
        $codigoPanal = $raw['codigoPanal']?? null;
        $celda = $raw['celda']?? null;
        $numeroIdentificacion = $raw['numeroIdentificacion']?? null;
        $nombre = $raw['nombre']?? null;
        $placa = $raw['placa']?? null;
        $imagen = $raw['imagenBase64']?? null;
        $arPanal = $em->getRepository(Panal::class)->find($codigoPanal);
        if($arPanal) {
            $arCelda = $em->getRepository(Celda::class)->findOneBy(['panalId' => $codigoPanal, 'celda' => $celda]);
            if($arCelda) {
                $codigo = rand(10000, 99999);
                $arVisita = new Visita();
                $arVisita->setPanal($arPanal);
                $arVisita->setCelda($arCelda);
                $arVisita->setFecha(new \DateTime('now'));
                $arVisita->setNumeroIdentificacion($numeroIdentificacion);
                $arVisita->setNombre($nombre);
                $arVisita->setPlaca($placa);
                $arVisita->setCodigoIngreso($codigo);
                if($imagen) {
                    $spaceDO = new SpaceDO();
                    $archivo = $spaceDO->subirB64('visita', $imagen);
                    $arVisita->setUrlImagenIngreso($archivo['url']);
                }
                $em->persist($arVisita);
                $em->flush();
                //Usuarios a los que se debe notificar
                if($arCelda) {
                    $firebase = new Firebase();
                    $arCeldaUsuarios = $em->getRepository(CeldaUsuario::class)->findBy(['celdaId' => $arCelda->getId()]);
                    foreach ($arCeldaUsuarios as $arCeldaUsuario) {
                        $firebase->nuevaVisita($arCeldaUsuario->getUsuario()->getTokenFirebase(), $arVisita->getId(), $nombre, 0);
                    }
                }
                return [
                    'error' => false,
                    'respuesta' => [
                        'codigoVisita' => $arVisita->getId(),
                        'codigoIngreso' => $codigo
                    ]
                ];
            } else {
                return [
                    'error' => true,
                    'errorMensaje' => "No existe la celda"
                ];
            }
        } else {
            return [
                'error' => true,
                'errorMensaje' => "No existe el panal"
            ];
        }
    }

    public function detalle($codigoVisita)
    {
        $em = $this->getEntityManager();
        $queryBuilder = $em->createQueryBuilder()->from(Visita::class, 'v')
            ->select('v.id')
            ->addSelect('v.fecha')
            ->addSelect('v.numeroIdentificacion')
            ->addSelect('v.nombre')
            ->addSelect('v.placa')
            ->addSelect('v.estadoAutorizado')
            ->addSelect('v.codigoIngreso')
            ->addSelect("CONCAT('{$_ENV['ALMACENAMIENTO_URL']}', v.urlImagenIngreso) as urlImagenIngreso")
            ->where("v.id = {$codigoVisita}");
        $arVisita = $queryBuilder->getQuery()->getOneOrNullResult();
        return [
            'error' => false,
            'respuesta' => [
                'visita' => $arVisita
            ]
        ];
    }

    public function pendiente($codigoPanal, $celda, $estadoAutorizado, $codigoIngreso)
    {
        $em = $this->getEntityManager();
        $queryBuilder = $em->createQueryBuilder()->from(Visita::class, 'v')
            ->select('v.id')
            ->addSelect('v.fecha')
            ->addSelect('v.numeroIdentificacion')
            ->addSelect('v.nombre')
            ->addSelect('v.placa')
            ->addSelect('v.codigoIngreso')
            ->addSelect('v.estadoAutorizado')
            ->addSelect('v.estadoCerrado')
            ->addSelect("CONCAT('{$_ENV['ALMACENAMIENTO_URL']}', v.urlImagenIngreso) as urlImagenIngreso")
            ->addSelect('c.celda')
            ->addSelect('c.celular')
            ->addSelect('c.correo')
            ->leftJoin('v.celda', 'c')
            ->where("v.panalId = {$codigoPanal}")
            ->andWhere('v.estadoCerrado = false');
        if($celda) {
            $queryBuilder->andWhere("v.celda = '{$celda}'");
        }
        if($estadoAutorizado) {
            $queryBuilder->andWhere("v.estadoAutorizado = '{$estadoAutorizado}'");
        }
        if($codigoIngreso) {
            $queryBuilder->andWhere("v.codigoIngreso = '{$codigoIngreso}'");
        }
        $arVisitas = $queryBuilder->getQuery()->getResult();
        return [
            'error' => false,
            'respuesta' => [
                'visitas' => $arVisitas
            ]
        ];
    }

    public function autorizar($codigoVisita, $codigoUsuario)
    {
        $em = $this->getEntityManager();
        $arVisita = $em->getRepository(Visita::class)->find($codigoVisita);
        if($arVisita) {
            if($arVisita->isEstadoAutorizado() == false) {
                if($arVisita->isEstadoCerrado() == false) {
                    $arUsuario = $em->getRepository(Usuario::class)->find($codigoUsuario);
                    if($arUsuario) {
                        $arVisita->setUsuarioAutoriza($arUsuario);
                        $arVisita->setEstadoAutorizado(true);
                        $em->persist($arVisita);
                        $em->flush();
                        return [
                            'error' => false,
                            'respuesta' => [
                                'mensaje' => 'Visita autorizada con exito'
                            ]

                        ];
                    } else {
                        return [
                            'error' => true,
                            'errorMensaje' => "No existe el usuario"
                        ];
                    }
                } else {
                    return [
                        'error' => true,
                        'errorMensaje' => "La visita fue cerrada"
                    ];
                }
            } else {
                return [
                    'error' => true,
                    'errorMensaje' => "La visita no esta pendiente de autorizacion"
                ];
            }
        } else {
            return [
                'error' => true,
                'errorMensaje' => "No existe la visita"
            ];
        }
    }

    public function cerrar($codigoVisita, $codigoUsuario)
    {
        $em = $this->getEntityManager();
        $arVisita = $em->getRepository(Visita::class)->find($codigoVisita);
        if($arVisita) {
            if($arVisita->isEstadoCerrado() == false) {
                $arUsuario = $em->getRepository(Usuario::class)->find($codigoUsuario);
                if($arUsuario) {
                    $arVisita->setEstadoCerrado(true);
                    $em->persist($arVisita);
                    $em->flush();
                    return [
                        'error' => false,
                        'respuesta' => [
                            'mensaje' => 'Se cerró la visita con exito'
                        ]
                    ];
                } else {
                    return [
                        'error' => true,
                        'errorMensaje' => "No existe el usuario"
                    ];
                }
            } else {
                return [
                    'error' => true,
                    'errorMensaje' => "La visita ya esta cerrada con anterioridad"
                ];
            }

        } else {
            return [
                'error' => true,
                'errorMensaje' => "No existe la visita"
            ];
        }
    }
}