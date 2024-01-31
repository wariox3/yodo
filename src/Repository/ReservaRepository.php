<?php

namespace App\Repository;

use App\Entity\Reserva;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class ReservaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Reserva::class);
    }

    public function lista($codigoPanal) {
        $em = $this->getEntityManager();
        $queryBuilder = $em->createQueryBuilder()->from(Reserva::class, 'r')
            ->select('r.id')
            ->addSelect('r.nombre')
            ->addSelect('r.descripcion')
            ->where("r.panal = {$codigoPanal}")
            ->setMaxResults(20);
        $arReservas = $queryBuilder->getQuery()->getResult();
        $respuesta = [
            'error' => false,
            'respuesta' => [
                'reserva' => $arReservas
            ]
        ];
        return $respuesta;
    }
}
