<?php

namespace App\Repository;

use App\Entity\Servicio;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class ServicioRepository extends ServiceEntityRepository
{

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Servicio::class);
    }

    public function pendiente()
    {
        $em = $this->getEntityManager();
        $queryBuilder = $em->createQueryBuilder()->from(Servicio::class, 's')
            ->select('s.id')
            ->addSelect('s.fecha')
            ->addSelect('s.descripcion')
            ->where("s.estadoAsignado = false");
        $arServicios = $queryBuilder->getQuery()->getResult();
        return [
            'error' => false,
            'respuesta' => [
                'servicios' => $arServicios
            ]
        ];
    }

}
