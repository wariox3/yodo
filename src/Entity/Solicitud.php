<?php

namespace App\Entity;

use App\Repository\AtencionRepository;
use App\Repository\ServicioRepository;
use App\Repository\SolicitudRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SolicitudRepository::class)]
class Solicitud
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: "datetime")]
    private $fecha = null;

    #[ORM\Column(length: 200, nullable: true)]
    private $descripcion = null;

    #[ORM\Column(type: "integer")]
    private $usuarioId;

    #[ORM\Column(type: "integer", nullable: true)]
    private $usuarioAsignadoId;

    #[ORM\Column(type: "boolean", options: ["default" => false])]
    private $estadoAsignado = false;

    #[ORM\ManyToOne(targetEntity: Usuario::class, inversedBy: 'solicitudes')]
    #[ORM\JoinColumn(name: "usuario_id", referencedColumnName: "id")]
    private $usuario;

    #[ORM\ManyToOne(targetEntity: Usuario::class, inversedBy: 'solicitudesUsuarioAsignado')]
    #[ORM\JoinColumn(name: "usuario_asignado_id", referencedColumnName: "id")]
    private $usuarioAsignado;

    #[ORM\OneToMany(targetEntity: SolicitudAplicacion::class, mappedBy: 'solicitud')]
    private Collection $solicitudesAplicaciones;

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
     * @return null
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * @param null $fecha
     */
    public function setFecha($fecha): void
    {
        $this->fecha = $fecha;
    }

    /**
     * @return null
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * @param null $descripcion
     */
    public function setDescripcion($descripcion): void
    {
        $this->descripcion = $descripcion;
    }

    /**
     * @return mixed
     */
    public function getUsuarioId()
    {
        return $this->usuarioId;
    }

    /**
     * @param mixed $usuarioId
     */
    public function setUsuarioId($usuarioId): void
    {
        $this->usuarioId = $usuarioId;
    }

    /**
     * @return mixed
     */
    public function getUsuarioAsignadoId()
    {
        return $this->usuarioAsignadoId;
    }

    /**
     * @param mixed $usuarioAsignadoId
     */
    public function setUsuarioAsignadoId($usuarioAsignadoId): void
    {
        $this->usuarioAsignadoId = $usuarioAsignadoId;
    }

    /**
     * @return bool
     */
    public function isEstadoAsignado(): bool
    {
        return $this->estadoAsignado;
    }

    /**
     * @param bool $estadoAsignado
     */
    public function setEstadoAsignado(bool $estadoAsignado): void
    {
        $this->estadoAsignado = $estadoAsignado;
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

    /**
     * @return mixed
     */
    public function getUsuarioAsignado()
    {
        return $this->usuarioAsignado;
    }

    /**
     * @param mixed $usuarioAsignado
     */
    public function setUsuarioAsignado($usuarioAsignado): void
    {
        $this->usuarioAsignado = $usuarioAsignado;
    }

    /**
     * @return Collection
     */
    public function getSolicitudesAplicaciones(): Collection
    {
        return $this->solicitudesAplicaciones;
    }

    /**
     * @param Collection $solicitudesAplicaciones
     */
    public function setSolicitudesAplicaciones(Collection $solicitudesAplicaciones): void
    {
        $this->solicitudesAplicaciones = $solicitudesAplicaciones;
    }



}
