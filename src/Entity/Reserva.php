<?php

namespace App\Entity;

use App\Repository\ReservaRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReservaRepository::class)]
class Reserva
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 200, nullable: true)]
    private $nombre;

    #[ORM\Column(type: 'text', nullable: true)]
    private $descripcion;

    #[ORM\ManyToOne(targetEntity: Panal::class, inversedBy: 'reservas')]
    #[ORM\JoinColumn(name: "panal_id", referencedColumnName: "id")]
    private $panal;


    #[ORM\OneToMany(targetEntity: ReservaDetalle::class, mappedBy: 'resevas')]
    private Collection $reservasDetalles;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(?string $nombre): static
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(?string $descripcion): static
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPanal()
    {
        return $this->panal;
    }

    /**
     * @param mixed $panal
     */
    public function setPanal($panal): void
    {
        $this->panal = $panal;
    }

    public function getReservasDetalles(): Collection
    {
        return $this->reservasDetalles;
    }

    public function setReservasDetalles(Collection $reservasDetalles): void
    {
        $this->reservasDetalles = $reservasDetalles;
    }


}
