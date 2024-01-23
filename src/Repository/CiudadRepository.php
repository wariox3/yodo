<?php

namespace App\Repository;

use App\Entity\Ciudad;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;


class CiudadRepository extends ServiceEntityRepository
{

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Ciudad::class);
    }

    public function buscar() {
        $em = $this->getEntityManager();
        $queryBuilder = $em->createQueryBuilder()->from(Ciudad::class, 'c')
            ->select('c.id')
            ->addSelect('c.nombre');
        $arCiudades = $queryBuilder->getQuery()->getResult();
        return [
            'error' => false,
            'respuesta' => $arCiudades
        ];
    }
}