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
     * @return mixed
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * @param mixed $nombre
     */
    public function setNombre($nombre): void
    {
        $this->nombre = $nombre;
    }

    /**
     * @return Collection
     */
    public function getDespachos(): Collection
    {
        return $this->despachos;
    }

    /**
     * @param Collection $despachos
     */
    public function setDespachos(Collection $despachos): void
    {
        $this->despachos = $despachos;
    }


}
