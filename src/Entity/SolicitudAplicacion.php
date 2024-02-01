<?php

namespace App\Entity;

use App\Repository\AtencionRepository;
use App\Repository\ServicioRepository;
use App\Repository\SolicitudAplicacionRepository;
use App\Repository\SolicitudRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SolicitudAplicacionRepository::class)]
class SolicitudAplicacion
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: "datetime")]
    private $fecha = null;

    #[ORM\Column(type: "integer")]
    private $usuarioId;

    #[ORM\Column(type: "integer")]
    private $solicitudId;

    #[ORM\Column(type: "boolean", options: ["default" => false])]
    private $estadoAsignado = false;

    #[ORM\ManyToOne(targetEntity: Usuario::class, inversedBy: 'solicitudesAplicaciones')]
    #[ORM\JoinColumn(name: "usuario_id", referencedColumnName: "id")]
    private $usuario;

    #[ORM\ManyToOne(targetEntity: Solicitud::class, inversedBy: 'solicitudesAplicaciones')]
    #[ORM\JoinColumn(name: "solicitud_id", referencedColumnName: "id")]
    private $solicitud;

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
    public function getSolicitudId()
    {
        return $this->solicitudId;
    }

    /**
     * @param mixed $solicitudId
     */
    public function setSolicitudId($solicitudId): void
    {
        $this->solicitudId = $solicitudId;
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
    public function getSolicitud()
    {
        return $this->solicitud;
    }

    /**
     * @param mixed $solicitud
     */
    public function setSolicitud($solicitud): void
    {
        $this->solicitud = $solicitud;
    }


}
