<?php

namespace App\Entity;

use App\Repository\DespachoRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DespachoRepository::class)]
class Despacho
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: "integer")]
    private $operadorId;

    #[ORM\Column(type: "datetime")]
    private $fechaCreacion = null;

    #[ORM\Column(type: "datetime")]
    private $fechaSalida = null;

    #[ORM\Column(type: "integer")]
    private $codigo;

    #[ORM\Column(type: "integer")]
    private $numero;

    #[ORM\ManyToOne(targetEntity: Operador::class, inversedBy: 'despachos')]
    #[ORM\JoinColumn(name: "operador_id", referencedColumnName: "id")]
    private $operador;

    #[ORM\OneToMany(targetEntity: Guia::class, mappedBy: 'despacho')]
    private Collection $guias;

}
