<?php

namespace App\Entity;

use App\Repository\ReservaDetalleRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReservaDetalleRepository::class)]
class ReservaDetalle
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private ?\DateTimeInterface $fecha = null;

    #[ORM\Column(type: 'text', length: 1000, nullable: true)]
    private ?string $comentario = null;

    #[ORM\ManyToOne(targetEntity: Reserva::class, inversedBy: 'reservasDetalles')]
    #[ORM\JoinColumn(name: "reserva_id", referencedColumnName: "id")]
    private $resevas;

    #[ORM\ManyToOne(targetEntity: Celda::class, inversedBy: 'reservasDetalles')]
    #[ORM\JoinColumn(name: "celda_id", referencedColumnName: "id")]
    private $celda;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFecha(): ?\DateTimeInterface
    {
        return $this->fecha;
    }

    public function setFecha(?\DateTimeInterface $fecha): static
    {
        $this->fecha = $fecha;

        return $this;
    }

    public function getComentario(): ?string
    {
        return $this->comentario;
    }

    public function setComentario(?string $comentario): static
    {
        $this->comentario = $comentario;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getResevas()
    {
        return $this->resevas;
    }

    /**
     * @param mixed $resevas
     */
    public function setResevas($resevas): void
    {
        $this->resevas = $resevas;
    }

    /**
     * @return mixed
     */
    public function getCelda()
    {
        return $this->celda;
    }

    /**
     * @param mixed $celda
     */
    public function setCelda($celda): void
    {
        $this->celda = $celda;
    }




}
