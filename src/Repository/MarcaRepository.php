<?php

namespace App\Repository;

use App\Entity\Marca;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class MarcaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Marca::class);
    }

    public function buscar($nombre = null)
    {
        $em = $this->getEntityManager();
        $queryBuilder = $em->createQueryBuilder()->from(Marca::class, 'm')
            ->select('m.id')
            ->addSelect('m.nombre');
        if($nombre) {
            $queryBuilder->andWhere("m.nombre like '%{$nombre}%'");
        }
        $arMarcas = $queryBuilder->getQuery()->getResult();
        return [
            'error' => false,
            'respuesta' => [
                'marcas' => $arMarcas
            ]
        ];
    }

}