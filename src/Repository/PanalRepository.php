<?php

namespace App\Repository;

use App\Entity\Ciudad;
use App\Entity\Panal;
use App\Entity\Usuario;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;


class PanalRepository extends ServiceEntityRepository
{

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Panal::class);
    }

    public function buscar($codigoCiudad = null) {
        $em = $this->getEntityManager();
        $queryBuilder = $em->createQueryBuilder()->from(Panal::class, 'p')
            ->select('p.id')
            ->addSelect('p.nombre');
        if($codigoCiudad) {
            $queryBuilder->andWhere("p.ciudadId = {$codigoCiudad}");
        }
        $arPanales = $queryBuilder->getQuery()->getResult();
        return [
            'error' => false,
            'respuesta' => $arPanales
        ];
    }

    public function asignar($codigoUsuario, $codigoPanal, $codigoCiudad) {
        $em = $this->getEntityManager();
        $arUsuario = $em->getRepository(Usuario::class)->find($codigoUsuario);
        if ($arUsuario) {
            if ($arUsuario->getPanal() == null) {
                $arCiudad = $em->getRepository(Ciudad::class)->find($codigoCiudad);
                if ($arCiudad) {
                    $arPanal = $em->getRepository(Panal::class)->find($codigoPanal);
                    if ($arPanal) {
                        $arUsuario->setPanal($arPanal);
                        $arUsuario->setCiudad($arCiudad);
                        $em->persist($arUsuario);
                        $em->flush();
                        return [
                            'error' => false,
                            'respuesta' => [
                                'panal' => $arPanal->getId(),
                                'ciudad' => $arCiudad->getId(),
                                'oferta' => false,
                                'tienda' => false
                            ]
                        ];
                    } else {
                        return [
                            'error' => true,
                            'errorMensaje' => "El panal no existe"
                        ];
                    }
                } else {
                    return [
                        'error' => true,
                        'errorMensaje' => "La ciudad no existe"
                    ];
                }
            } else {
                return [
                    'error' => true,
                    'errorMensaje' => "El usuario ya tiene un panal asignado, debe desvincularse de este panal para seleccionar uno nuevo"
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