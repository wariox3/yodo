<?php

namespace App\Repository;

use App\Entity\Conductor;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class ConductorRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Conductor::class);
    }

    public function lista()
    {
        $em = $this->getEntityManager();
        $queryBuilder = $em->createQueryBuilder()->from(Conductor::class, 'c')
            ->select('c.id')
            ->addSelect('c.nombre')
            ->addSelect('c.alias')
            ->addSelect('c.numeroIdentificacion')
            ->addSelect('c.fechaNacimiento');
        $arConductores = $queryBuilder->getQuery()->getResult();
        return [
            'error' => false,
            'respuesta' => [
                'conductores' => $arConductores
            ]
        ];
    }

    public function nuevo($nombre, $alias, $fechaNacimiento, $numeroIdentificacion)
    {
        $em = $this->getEntityManager();
        $arConductor = new Conductor();
        $arConductor->setNombre($nombre);
        $arConductor->setAlias($alias);
        $arConductor->setFechaNacimiento(new \DateTime($fechaNacimiento));
        $arConductor->setNumeroIdentificacion($numeroIdentificacion);
        $em->persist($arConductor);
        $em->flush();
        return [
            'error' => false,
            'respuesta' => [
                'codigoConductor' => $arConductor->getId(),
            ]
        ];
    }

    public function detalle($codigoConductor)
    {
        $em = $this->getEntityManager();
        $queryBuilder = $em->createQueryBuilder()->from(Conductor::class, 'c')
            ->select('c.id')
            ->addSelect('c.nombre')
            ->addSelect('c.alias')
            ->addSelect('c.numeroIdentificacion')
            ->addSelect('c.fechaNacimiento')
            ->where("c.id = {$codigoConductor}");
        $arConductor = $queryBuilder->getQuery()->getResult();
        return [
            'error' => false,
            'respuesta' => [
                'conductor' => $arConductor
            ]
        ];
    }

    public function buscar()
    {
        $em = $this->getEntityManager();
        $queryBuilder = $em->createQueryBuilder()->from(Conductor::class, 'c')
            ->select('c.id')
            ->addSelect('c.nombre')
            ->setMaxResults(10);
        $arConductores = $queryBuilder->getQuery()->getResult();
        return [
            'error' => false,
            'respuesta' => [
                'conductores' => $arConductores
            ]
        ];
    }

}
