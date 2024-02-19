<?php

namespace App\Entity;

use App\Repository\OperadorRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OperadorRepository::class)]
class Operador
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 200)]
    private $nombre;

    #[ORM\OneToMany(targetEntity: Despacho::class, mappedBy: 'operador')]
    private Collection $despachos;

}
