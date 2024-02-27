<?php


namespace App\Entity;

use App\Repository\LineaRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LineaRepository::class)]
class Linea
{
    #[ORM\Id]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: 'integer')]
    private $marcaId;

    #[ORM\Column(type: 'integer')]
    private $codigo;

    #[ORM\Column(length: 100)]
    private ?string $nombre = null;

    #[ORM\ManyToOne(targetEntity: Marca::class, inversedBy: 'lineas')]
    #[ORM\JoinColumn(name: "marca_id", referencedColumnName: "id")]
    private $marca;

    #[ORM\OneToMany(targetEntity: Vehiculo::class, mappedBy: 'linea')]
    private Collection $vehiculos;

}

