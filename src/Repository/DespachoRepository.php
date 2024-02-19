<?php

namespace App\Repository;

use App\Entity\Despacho;
use App\Entity\Operador;
use App\Entity\Usuario;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class DespachoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Despacho::class);
    }

    public function nuevo($codigoUsuario, $operador, $codigoDespacho, $token)
    {
        $em = $this->getEntityManager();
        $arUsuario = $em->getRepository(Usuario::class)->find($codigoUsuario);
        if($arUsuario) {
            $arOperador = $em->getRepository(Operador::class)->find($operador);
            if($arOperador) {
                $arDespacho = $em->getRepository(Despacho::class)->findOneBy(['operadorId' => $operador, 'codigo' => $codigoDespacho]);
                if($arDespacho) {
                    if($arDespacho->getUsuario()) {
                        if($arDespacho->getUsuarioId() == $codigoUsuario) {
                            return [
                                'error' => true,
                                'errorMensaje' => "El despacho ya fue cargado con anterioridad"
                            ];
                        } else {
                            return [
                                'error' => true,
                                'errorMensaje' => "El despacho ya fue cargado por otro usuario"
                            ];
                        }
                    } else {
                        $arDespacho->setUsuario($arUsuario);
                        $em->persist($arDespacho);
                        $em->flush();
                        return [
                            'error' => false,
                            'respuesta' => [
                                'id' => $arDespacho->getId(),
                            ]
                        ];
                    }
                } else {
                    $parametros = [
                        "codigoDespacho" => $codigoDespacho,
                    ];
                    /*$respuesta = $this->cromo->post($arOperador, '/api/transporte/despacho/cargar', $parametros);
                    if($respuesta['error'] == false) {
                        $arDespacho = new Despacho();
                        $arDespacho->setFecha(new \DateTime('now'));
                        $arDespacho->setFechaDespacho(date_create($respuesta['fecha']));
                        $arDespacho->setCodigoDespachoClaseFk($respuesta['codigoDespachoClase']);
                        $arDespacho->setUsuarioRel($arUsuario);
                        $arDespacho->setOperadorRel($arOperador);
                        $arDespacho->setCodigoDespacho($codigoDespacho);
                        $arDespacho->setToken($token);
                        $em->persist($arDespacho);
                        $em->flush();
                        return [
                            'error' => false,
                            'codigoDespacho' => $arDespacho->getCodigoDespachoPk(),
                        ];
                    } else {
                        return $respuesta;
                    }*/
                    return [
                        'error' => false,
                        'respuesta' => [
                            'codigoCaso' => 1,
                        ]
                    ];


                }
            } else {
                return [
                    'error' => true,
                    'errorMensaje' => "No existe el operador"
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
