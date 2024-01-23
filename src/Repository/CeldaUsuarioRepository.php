<?php

namespace App\Repository;

use App\Entity\Celda;
use App\Entity\CeldaUsuario;
use App\Entity\Usuario;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;


class CeldaUsuarioRepository extends ServiceEntityRepository
{

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CeldaUsuario::class);
    }

}