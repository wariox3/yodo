<?php


namespace App\Entity;

use App\Repository\CarroceriaRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CarroceriaRepository::class)]
class Carroceria
{
    #[ORM\Id]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $nombre = null;

    #[ORM\OneToMany(targetEntity: Vehiculo::class, mappedBy: 'carroceria')]
    private Collection $vehiculos;

    #[ORM\OneToMany(targetEntity: Solicitud::class, mappedBy: 'carroceria')]
    private Collection $solicitudes;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string|null
     */
    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    /**
     * @param string|null $nombre
     */
    public function setNombre(?string $nombre): void
    {
        $this->nombre = $nombre;
    }

    /**
     * @return Collection
     */
    public function getVehiculos(): Collection
    {
        return $this->vehiculos;
    }

    /**
     * @param Collection $vehiculos
     */
    public function setVehiculos(Collection $vehiculos): void
    {
        $this->vehiculos = $vehiculos;
    }

    /**
     * @return Collection
     */
    public function getSolicitudes(): Collection
    {
        return $this->solicitudes;
    }

    /**
     * @param Collection $solicitudes
     */
    public function setSolicitudes(Collection $solicitudes): void
    {
        $this->solicitudes = $solicitudes;
    }


}

