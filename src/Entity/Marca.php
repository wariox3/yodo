<?php


namespace App\Entity;

use App\Repository\MarcaRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MarcaRepository::class)]
class Marca
{
    #[ORM\Id]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $nombre = null;

    #[ORM\OneToMany(targetEntity: Vehiculo::class, mappedBy: 'marca')]
    private Collection $vehiculos;

    #[ORM\OneToMany(targetEntity: Linea::class, mappedBy: 'marca')]
    private Collection $lineas;
}

