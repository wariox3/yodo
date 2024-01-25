<?php

namespace App\Repository;

use App\Entity\Entrega;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class EntregaRepository extends ServiceEntityRepository
{

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Entrega::class);
    }

    public function lista($codigoCelda) {
        $em = $this->getEntityManager();
        $queryBuilder = $em->createQueryBuilder()->from(Entrega::class, 'e')
            ->select('e.id')
            ->addSelect('e.fechaIngreso')
            ->addSelect('e.descripcion')
            ->addSelect('e.entregaTipoId')
            ->addSelect('e.estadoEntregado')
            ->addSelect("CONCAT('{$_ENV['ALMACENAMIENTO_URL']}', e.urlImagenIngreso) as urlImagenIngreso")
            ->where("e.celdaId = {$codigoCelda}")
            ->setMaxResults(20);
        $arEntregas = $queryBuilder->getQuery()->getResult();
        $respuesta = [
            'error' => false,
            'respuesta' => [
                'entregas' => $arEntregas
            ]
        ];
        return $respuesta;
    }
}