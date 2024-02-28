<?php

namespace App\Repository;

use App\Entity\Configuracion;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;


class ConfiguracionRepository extends ServiceEntityRepository
{

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Configuracion::class);
    }

    public function lista()
    {
        $em = $this->getEntityManager();
        $queryBuilder = $em->createQueryBuilder()->from(Configuracion::class, 'c')
            ->select('c.id')
            ->addSelect('c.codigo')
            ->addSelect('c.nombre')
            ->addSelect('c.descripcion')
            ->addSelect('c.tipo')
            ->addSelect('c.pesoMaximo')
            ->addSelect('c.pesoMinimo');
        $arConfiguracion = $queryBuilder->getQuery()->getResult();
        return [
            'error' => false,
            'respuesta' => [
                'configuraciones' => $arConfiguracion
            ]
        ];
    }
}