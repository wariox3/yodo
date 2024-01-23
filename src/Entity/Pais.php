<?php


namespace App\Entity;

use App\Repository\PaisRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PaisRepository::class)]
class Pais
{
    #[ORM\Id]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 80)]
    private ?string $nombre = null;

    #[ORM\OneToMany(targetEntity: Estado::class, mappedBy: 'pais')]
    private Collection $estados;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     */
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
    public function getEstados(): Collection
    {
        return $this->estados;
    }

    /**
     * @param Collection $estados
     */
    public function setEstados(Collection $estados): void
    {
        $this->estados = $estados;
    }


}

