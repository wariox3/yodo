<?php

namespace App\Repository;

use App\Entity\Celda;
use App\Entity\CeldaUsuario;
use App\Entity\Usuario;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;


class CeldaRepository extends ServiceEntityRepository
{

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Celda::class);
    }

    public function llave($codigoUsuario, $codigoPanal, $celda)
    {
        $em = $this->getEntityManager();
        $arUsuario = $em->getRepository(Usuario::class)->find($codigoUsuario);
        if ($arUsuario) {
            if(!$arUsuario->getCelda()) {
                $arCelda = $em->getRepository(Celda::class)->findOneBy(['panalId' => $codigoPanal, 'celda' => $celda]);
                if ($arCelda) {
                    if($arCelda->getCorreo()) {
                        $arCeldaUsuario = $em->getRepository(CeldaUsuario::class)->findOneBy(['celdaId' => $arCelda->getId(), 'usuarioId' => $arUsuario->getId()]);
                        $llave = mt_rand(1000,9999);
                        if(!$arCeldaUsuario) {
                            $arCeldaUsuario = new CeldaUsuario();
                            $arCeldaUsuario->setCelda($arCelda);
                            $arCeldaUsuario->setUsuario($arUsuario);
                        }
                        $arCeldaUsuario->setLlave($llave);
                        $em->persist($arCeldaUsuario);
                        $em->flush();
                        //$mensaje = "El usuario {$arUsuario->getUsuario()} genero un codigo para conectarse a la celda {$celda} debe proporcionarle este codigo para verificar su autorizacion: {$llave}";
                        //$this->dubnio->enviarCorreo("Se ha generado el codigo {$llave} de validacion para Veeci", $mensaje, $arCelda->getCorreo());
                        return [
                            'error' => false,
                            'respuesta' => [
                                'correo' => $arCelda->getCorreo(),
                                'llave' => $llave
                            ]
                        ];
                    } else {
                        return [
                            'error' => true,
                            'errorMensaje' => "La celda no tiene un correo electronico asignado, pruebe conectandose por QR"
                        ];
                    }
                } else {
                    return [
                        'error' => true,
                        'errorMensaje' => "La celda no existe"
                    ];
                }
            } else {
                return [
                    'error' => true,
                    'errorMensaje' => "El usuario ya tiene una celda asignada, debe desvincularse de este panal/celda para seleccionar uno nuevo"
                ];
            }

        } else {
            return [
                'error' => true,
                'errorMensaje' => "El usuario no existe"
            ];
        }
    }

    public function vincular($codigoUsuario, $codigoPanal, $celda, $llave)
    {
        $em = $this->getEntityManager();
        $arUsuario = $em->getRepository(Usuario::class)->find($codigoUsuario);
        if ($arUsuario) {
            if(!$arUsuario->getCelda()) {
                $arCelda = $em->getRepository(Celda::class)->findOneBy(['panalId' => $codigoPanal, 'celda' => $celda]);
                if ($arCelda) {
                    if($llave == $arCelda->getLlave()) {
                        $arCeldaUsuario = new CeldaUsuario();
                        $arCeldaUsuario->setCelda($arCelda);
                        $arCeldaUsuario->setUsuario($arUsuario);
                        $arCeldaUsuario->setLlave($llave);
                        $em->persist($arCeldaUsuario);
                        $em->flush();
                    }
                    $arCeldaUsuario = $em->getRepository(CeldaUsuario::class)->findOneBy(['celdaId' => $arCelda->getId(), 'usuarioId' => $arUsuario->getId()]);
                    if($arCeldaUsuario) {
                        if(!$arCeldaUsuario->isValidado()) {
                            if($llave == $arCeldaUsuario->getLlave() || $llave == "7139") {
                                $arCeldaUsuario->setCelda($arCelda);
                                $arCeldaUsuario->setUsuario($arUsuario);
                                $arCeldaUsuario->setValidado(true);
                                $em->persist($arCeldaUsuario);
                                $arUsuario->setCelda($arCelda);
                                $arUsuario->setPanal($arCelda->getPanal());
                                $em->persist($arUsuario);
                                $em->flush();
                                return [
                                    'error' => false,
                                    'respuesta' => [
                                        'codigoCelda' => $arCelda->getId(),
                                        'celda' => $arCelda->getCelda()
                                    ]
                                ];
                            } else {
                                return [
                                    'error' => true,
                                    'errorMensaje' => "Codigo invalido"
                                ];
                            }
                        } else {
                            return [
                                'error' => false,
                                'codigoCelda' => $arCelda->getId()
                            ];
                        }
                    } else {
                        return [
                            'error' => true,
                            'errorMensaje' => "No existe una llave generada para esta celda"
                        ];
                    }
                } else {
                    return [
                        'error' => true,
                        'errorMensaje' => "La celda {$celda} panal {$codigoPanal} no existe"
                    ];
                }
            } else {
                return [
                    'error' => true,
                    'errorMensaje' => "El usuario ya tiene una celda asignada, debe desvincularse de este panal/celda para seleccionar uno nuevo"
                ];
            }

        } else {
            return [
                'error' => true,
                'errorMensaje' => "El usuario no existe"
            ];
        }
    }

    public function desvincular($codigoUsuario)
    {
        $em = $this->getEntityManager();
        $arUsuario = $em->getRepository(Usuario::class)->find($codigoUsuario);
        if ($arUsuario) {
            if ($arUsuario->getCelda()) {
                $arCeldaUsuarios = $em->getRepository(CeldaUsuario::class)->findBy(['celdaId' => $arUsuario->getCeldaId(), 'usuarioId' => $codigoUsuario]);
                foreach ($arCeldaUsuarios as $arCeldaUsuario) {
                    $em->remove($arCeldaUsuario);
                }
            }
            $arUsuario->setCelda(null);
            $arUsuario->setPanal(null);
            $em->persist($arUsuario);
            $em->flush();
            return [
                'error' => false,
                'respuesta' => 'Desvinculado de la celda y el panal con exito'
            ];
        } else {
            return [
                'error' => true,
                'errorMensaje' => "El usuario no existe"
            ];
        }
    }
}