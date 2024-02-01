<?php

namespace App\Repository;

use App\Entity\Vehiculo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class VehiculoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Vehiculo::class);
    }

    public function lista()
    {
        $em = $this->getEntityManager();
        $queryBuilder = $em->createQueryBuilder()->from(Vehiculo::class, 'v')
            ->select('v.id')
            ->addSelect('v.modelo')
            ->addSelect('v.placa');
        $arVehiculos = $queryBuilder->getQuery()->getResult();
        return [
            'error' => false,
            'respuesta' => [
                'vehiculos' => $arVehiculos
            ]
        ];
    }

    public function nuevo($modelo, $placa)
    {
        $em = $this->getEntityManager();
        $arVehiculo = new Vehiculo();
        $arVehiculo->setModelo($modelo);
        $arVehiculo->setPlaca($placa);
        $em->persist($arVehiculo);
        $em->flush();
        return [
            'error' => false,
            'respuesta' => [
                'codigoVehiculo' => $arVehiculo->getId(),
            ]
        ];
    }
}
