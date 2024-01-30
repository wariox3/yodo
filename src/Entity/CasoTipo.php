<?php

namespace App\Entity;

use App\Repository\CasoTipoRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CasoTipoRepository::class)]
class CasoTipo
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 20)]
    private ?string $nombre = null;

    #[ORM\OneToMany(targetEntity: Caso::class, mappedBy: 'casoTipo')]
    private Collection $casos;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): static
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getCasos(): Collection
    {
        return $this->casos;
    }

    public function setCasos(Collection $casos): void
    {
        $this->casos = $casos;
    }


}
