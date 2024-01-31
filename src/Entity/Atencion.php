<?php

namespace App\Entity;

use App\Repository\AtencionRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AtencionRepository::class)]
class Atencion
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: "datetime", nullable: true)]
    private $fecha = null;

    #[ORM\Column(length: 200, nullable: true)]
    private $descripcion = null;

    #[ORM\Column(type: "boolean", options: ["default" => false])]
    private $estadoAtendido = false;

    #[ORM\ManyToOne(targetEntity: Celda::class, inversedBy: 'atenciones')]
    #[ORM\JoinColumn(name: "celda_id", referencedColumnName: "id")]
    private $celda = null;

    #[ORM\ManyToOne(targetEntity: Usuario::class, inversedBy: 'atenciones')]
    #[ORM\JoinColumn(name: "usuario_id", referencedColumnName: "id")]
    private $usuario;

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

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(?string $descripcion): static
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    public function isEstadoAtendido(): ?bool
    {
        return $this->estadoAtendido;
    }

    public function setEstadoAtendido(bool $estadoAtendido): static
    {
        $this->estadoAtendido = $estadoAtendido;

        return $this;
    }

    /**
     * @return null
     */
    public function getCelda()
    {
        return $this->celda;
    }

    /**
     * @param null $celda
     */
    public function setCelda($celda): void
    {
        $this->celda = $celda;
    }


    /**
     * @return mixed
     */
    public function getUsuario()
    {
        return $this->usuario;
    }

    /**
     * @param mixed $usuario
     */
    public function setUsuario($usuario): void
    {
        $this->usuario = $usuario;
    }


}
