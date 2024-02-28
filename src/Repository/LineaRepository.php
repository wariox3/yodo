<?php

namespace App\Repository;

use App\Entity\Linea;
use App\Entity\Marca;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;


class LineaRepository extends ServiceEntityRepository
{

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Linea::class);
    }

    public function buscar($codigoMarca, $nombre){
        $em = $this->getEntityManager();
        $arMarca = $em->getRepository(Marca::class)->find($codigoMarca);
        if($arMarca){
            $queryBuilder = $em->createQueryBuilder()->from(Linea::class, 'l')
                ->select('l.id')
                ->addSelect('l.nombre')
                ->where("l.marcaId = {$codigoMarca}");
            if($nombre) {
                $queryBuilder->andWhere("l.nombre like '%{$nombre}%'");
            }
            $arLinea = $queryBuilder->getQuery()->getResult();
            return [
                'error' => false,
                'respuesta' => [
                    'lineas' => $arLinea
                ]
            ];
        } else {
            return [
                'error' => true,
                'errorMensaje' => "No existe la marca"
            ];
        }

    }

}