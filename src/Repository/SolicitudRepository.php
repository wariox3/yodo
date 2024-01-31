<?php

namespace App\Repository;

use App\Entity\Solicitud;
use App\Entity\Usuario;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class SolicitudRepository extends ServiceEntityRepository
{

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Solicitud::class);
    }

    public function pendiente()
    {
        $em = $this->getEntityManager();
        $queryBuilder = $em->createQueryBuilder()->from(Solicitud::class, 's')
            ->select('s.id')
            ->addSelect('s.fecha')
            ->addSelect('s.descripcion')
            ->where("s.estadoAsignado = false");
        $arSolicitudes = $queryBuilder->getQuery()->getResult();
        return [
            'error' => false,
            'respuesta' => [
                'solicitudes' => $arSolicitudes
            ]
        ];
    }

    public function aplicar($codigoUsuario)
    {
        $em = $this->getEntityManager();
        $arUsuario = $em->getRepository(Usuario::class)->find($codigoUsuario);
        if($arUsuario) {
            return [
                'error' => false,
                'respuesta' => [
                    'mensaje' => 'Aplico correctamente a la solicitud'
                ]
            ];
        } else {
            return [
                'error' => true,
                'errorMensaje' => "No existe el usuario"
            ];
        }
    }

}
