<?php

namespace App\Repository;

use App\Entity\Celda;
use App\Entity\CeldaUsuario;
use App\Entity\Publicacion;
use App\Entity\Usuario;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;


class PublicacionRepository extends ServiceEntityRepository
{

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Publicacion::class);
    }

    public function queryLista($codigoPanal)
    {
        $em = $this->getEntityManager();
        $queryBuilder = $em->createQueryBuilder()->from(Publicacion::class, 'p')
            ->select('p.id')
            ->addSelect('p.fecha')
            ->addSelect('p.descripcion')
            ->addSelect("CONCAT('{$_ENV['ALMACENAMIENTO_URL']}', p.urlImagen) as urlImagen")
            ->addSelect('p.reacciones')
            ->addSelect('p.comentarios')
            ->addSelect('p.permiteComentarios')
            ->addSelect('p.usuarioId')
            ->addSelect("CONCAT('{$_ENV['ALMACENAMIENTO_URL']}', u.imagenPerfil) as usuarioImagenPerfil")
            ->addSelect('u.username as usuarioUsername')
            ->addSelect('u.nombreCorto as usuarioNombreCorto')
            ->leftJoin('p.usuario', 'u')
            ->where("p.panalId = {$codigoPanal}")
            ->andWhere("p.estadoAprobado = true")
            ->orderBy('p.fecha', 'DESC');
        return $queryBuilder;
    }

}