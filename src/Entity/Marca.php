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

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(?string $nombre): void
    {
        $this->nombre = $nombre;
    }

    public function getVehiculos(): Collection
    {
        return $this->vehiculos;
    }

    public function setVehiculos(Collection $vehiculos): void
    {
        $this->vehiculos = $vehiculos;
    }

    public function getLineas(): Collection
    {
        return $this->lineas;
    }

    public function setLineas(Collection $lineas): void
    {
        $this->lineas = $lineas;
    }


}

