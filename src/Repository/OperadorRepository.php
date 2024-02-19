<?php

namespace App\Repository;

use App\Entity\Operador;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class OperadorRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Operador::class);
    }

    public function lista()
    {
        $em = $this->getEntityManager();
        $queryBuilder = $em->createQueryBuilder()->from(Operador::class, 'o')
            ->select('o.id')
            ->addSelect('o.nombre');
        $arOperadores = $queryBuilder->getQuery()->getResult();
        return [
            'error' => false,
            'respuesta' => [
                'operadores' => $arOperadores
            ]
        ];
    }

    public function nuevo($nombre)
    {
        $em = $this->getEntityManager();
        $arOperador = new Operador();
        $arOperador->setNombre($nombre);
        $em->persist($arOperador);
        $em->flush();
        return [
            'error' => false,
            'respuesta' => [
                'id' => $arOperador->getId(),
            ]
        ];


    }

}
