<?php

namespace App\Repository;

use App\Entity\Atencion;
use App\Entity\Celda;
use App\Entity\Usuario;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class AtencionRepository extends ServiceEntityRepository
{

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Atencion::class);
    }

    public function apiLista($codigoCelda)
    {
        $em = $this->getEntityManager();
        $queryBuilder = $em->createQueryBuilder()->from(Atencion::class, 'a')
            ->select('a.id')
            ->addSelect('a.fecha')
            ->addSelect('a.descripcion')
            ->addSelect('a.estadoAtendido')
            ->where("a.celda = {$codigoCelda}");
        $arAtenciones = $queryBuilder->getQuery()->getResult();
        return [
            'error' => false,
            'respuesta' => [
                'atenciones' => $arAtenciones
            ]
        ];
    }

    public function apiNuevo($codigoUsuario, $codigoCelda, $descripcion)
    {
        $em = $this->getEntityManager();
        $arUsuario = $em->getRepository(Usuario::class)->find($codigoUsuario);
        if ($arUsuario) {
            $arCelda = $em->getRepository(Celda::class)->find($codigoCelda);
            if($arCelda) {
                $arAtencion = new Atencion();
                $arAtencion->setUsuario($arUsuario);
                $arAtencion->setCelda($arCelda);
                $arAtencion->setFecha(new \DateTime('now'));
                $arAtencion->setDescripcion($descripcion);
                $em->persist($arAtencion);
                $em->flush();
                return [
                    'error' => false,
                    'respuesta' => [
                        'codigoAtencion' => $arAtencion->getId()
                    ]
                ];
            } else {
                return [
                    'error' => true,
                    'errorMensaje' => "No existe la celda"
                ];
            }

        } else {
            return [
                'error' => true,
                'errorMensaje' => "No existe el usuario"
            ];
        }
    }

    public function apiPendiente($codigoPanal, $celda)
    {
        $em = $this->getEntityManager();
        $queryBuilder = $em->createQueryBuilder()->from(Atencion::class, 'a')
            ->select('a.id')
            ->addSelect('a.fecha')
            ->addSelect('a.descripcion')
            ->leftJoin('a.celda', 'c')
            ->where("c.panal = {$codigoPanal}")
            ->andWhere("a.estadoAtendido = false")
            ->addOrderBy("a.fecha", "ASC");
        $arAtencion = $queryBuilder->getQuery()->getResult();
        if($celda) {
            $queryBuilder->andWhere("c.celda = '{$celda}'");
        }
        return [
            'error' => false,
            'respuesta' => [
                'atencion' => $arAtencion
            ]
        ];
    }

    public function apiAtendido($codigoAtencion)
    {
        $em = $this->getEntityManager();
        $arAtencion = $em->getRepository(Atencion::class)->find($codigoAtencion);
        if($arAtencion){
            $arAtencion->setEstadoAtendido(true);
            $em->persist($arAtencion);
            $em->flush();
            return [
                'error' => false,
                'respuesta' => [
                    'mensaje' => 'La atención fue atendida con éxito'
                ]
            ];
        }else{
            return [
                'error' => true,
                'errorMensaje' => "No existe la atención"
            ];
        }
    }
}
