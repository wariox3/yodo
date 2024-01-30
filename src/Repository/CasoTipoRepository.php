<?php

namespace App\Repository;

use App\Entity\CasoTipo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class CasoTipoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CasoTipo::class);
    }

    public function apiBuscar($nombre)
    {
        $em = $this->getEntityManager();
        $queryBuilder = $em->createQueryBuilder()->from(CasoTipo::class, 'ct')
            ->select('ct.codigoCasoTipoPk')
            ->addSelect('ct.nombre')
            ->setMaxResults(10);
        if($nombre) {
            $queryBuilder->andWhere("ct.nombre like '%{$nombre}%'");
        }
        $arCasosTipos = $queryBuilder->getQuery()->getResult();
        return [
            'error' => false,
            'casosTipos' => $arCasosTipos
        ];
    }
}
