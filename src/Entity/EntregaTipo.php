<?php


namespace App\Entity;

use App\Repository\CiudadRepository;
use App\Repository\EntregaTipoRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EntregaTipoRepository::class)]
class EntregaTipo
{
    #[ORM\Id]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 80)]
    private ?string $nombre = null;

    #[ORM\OneToMany(targetEntity: Entrega::class, mappedBy: 'entregaTipo')]
    private Collection $entregas;

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

    public function getEntregas(): Collection
    {
        return $this->entregas;
    }

    public function setEntregas(Collection $entregas): void
    {
        $this->entregas = $entregas;
    }



}

