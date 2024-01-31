<?php

namespace App\Repository;

use App\Entity\Soporte;
use App\Entity\Usuario;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class SoporteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Soporte::class);
    }

    public function nuevo($codigoUsuario, $descripcion)
    {
        $em = $this->getEntityManager();
        $arUsuario = $em->getRepository(Usuario::class)->find($codigoUsuario);
        if ($arUsuario) {
            $arSoporte = new Soporte();
            $arSoporte->setUsuario($arUsuario);
            $arSoporte->setDescripcion($descripcion);
            $em->persist($arSoporte);
            $em->flush();
            return [
                'error' => false,
                'respuesta' => [
                    'codigoSoporte' => $arSoporte->getId(),
                ]
            ];

        } else {
            return [
                'error' => true,
                'errorMensaje' => "No existe el usuario"
            ];
        }
    }
}
