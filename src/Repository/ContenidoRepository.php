<?php

namespace App\Repository;

use App\Entity\Contenido;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class ContenidoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Contenido::class);
    }

    public function lista($codigoPanal) {
        $em = $this->getEntityManager();
        $queryBuilder = $em->createQueryBuilder()->from(Contenido::class, 'c')
            ->select('c.id')
            ->addSelect('c.nombre')
            ->addSelect('c.nombreArchivo')
            ->addSelect('c.url')
            ->where("c.panal = {$codigoPanal}");
        $arContenidos = $queryBuilder->getQuery()->getResult();
        $respuesta = [
            'error' => false,
            'respuesta' => [
                'contenidos' => $arContenidos
            ]
        ];
        return $respuesta;
    }


}
