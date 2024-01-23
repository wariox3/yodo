<?php

namespace App\Repository;

use App\Entity\Panal;
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
}