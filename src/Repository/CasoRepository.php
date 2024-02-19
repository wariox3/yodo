<?php

namespace App\Repository;

use App\Entity\Caso;
use App\Entity\CasoTipo;
use App\Entity\Usuario;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class CasoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Caso::class);
    }

    public function nuevo($tipo, $codigoUsuario, $descripcion)
    {
        $em = $this->getEntityManager();
        $arUsuario = $em->getRepository(Usuario::class)->find($codigoUsuario);
        if($arUsuario) {
            $arCasoTipo = $em->getRepository(CasoTipo::class)->find($tipo);
            if($arCasoTipo) {
                $arCaso = new Caso();
                $arCaso->setUsuario($arUsuario);
                $arCaso->setCasoTipo($arCasoTipo);
                $arCaso->setDescripcion($descripcion);
                $arCaso->setFecha(new \DateTime('now'));
                $arCaso->setPanal($arUsuario->getPanal());
                $arCaso->setNombre($arUsuario->getNombreCorto());
                $arCaso->setCelular($arUsuario->getCelular());
                $arCaso->setCorreo($arUsuario->getUsername());
                $em->persist($arCaso);
                $em->flush();
                return [
                    'error' => false,
                    'respuesta' => [
                        'codigoCaso' => $arCaso->getId(),
                    ]
                ];
            } else {
                return [
                    'error' => true,
                    'errorMensaje' => "No existe el tipo de caso"
                ];
            }
        } else {
            return [
                'error' => true,
                'errorMensaje' => "No existe el usuario"
            ];
        }
    }

    public function lista($codigoPanal, $codigoUsuario)
    {
        $em = $this->getEntityManager();
        $queryBuilder = $em->createQueryBuilder()->from(Caso::class, 'c')
            ->select('c.id')
            ->addSelect('c.fecha')
            ->addSelect('c.fechaAtendido')
            ->addSelect('ct.id as casoTipoId')
            ->addSelect('ct.nombre as casoTipoNombre')
            ->addSelect('c.descripcion')
            ->addSelect('c.nombre')
            ->addSelect('c.celular')
            ->addSelect('c.correo')
            ->addSelect('u.id usuarioId')
            ->addSelect('c.estadoAtendido')
            ->addSelect('c.estadoCerrado')
            ->leftJoin('c.casoTipo', 'ct')
            ->leftJoin('c.usuario', 'u')
            ->where("c.panal = {$codigoPanal}")
            ->andWhere("c.usuario = {$codigoUsuario}");
        $arCasos = $queryBuilder->getQuery()->getResult();
        return [
            'error' => false,
            'respuesta' => [
                'casos' => $arCasos
            ]
        ];
    }

}
