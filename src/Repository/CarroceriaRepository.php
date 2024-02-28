<?php

namespace App\Repository;

use App\Entity\Carroceria;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;


class CarroceriaRepository extends ServiceEntityRepository
{

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Carroceria::class);
    }


    public function buscar($nombre = null)
    {
        $em = $this->getEntityManager();
        $queryBuilder = $em->createQueryBuilder()->from(Carroceria::class, 'c')
            ->select('c.id')
            ->addSelect('c.nombre');
        if($nombre) {
            $queryBuilder->andWhere("c.nombre like '%{$nombre}%'");
        }
        $arCarrocerias = $queryBuilder->getQuery()->getResult();
        return [
            'error' => false,
            'respuesta' => [
                'carrocerias' => $arCarrocerias
            ]
        ];
    }

}