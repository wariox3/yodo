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

    #[ORM\Column(type: "integer")]
    private $ciudadOrigenId;

    #[ORM\Column(type: "integer")]
    private $ciudadDestinoId;

    #[ORM\Column(length: 200, nullable: true)]
    private $descripcion = null;

    #[ORM\Column(type: "float", options: ["default" => 0])]
    private $precio = 0.0;

    #[ORM\Column(type: "float", options: ["default" => 0])]
    private $peso = 0.0;

    #[ORM\Column(type: "float", options: ["default" => 0])]
    private $volumen = 0.0;

    #[ORM\Column(type: "integer", options: ["default" => 0])]
    private $entregas = 0;

    #[ORM\Column(type: 'integer')]
    private $carroceriaId;

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

    #[ORM\ManyToOne(targetEntity: Carroceria::class, inversedBy: 'solicitudes')]
    #[ORM\JoinColumn(name: "carroceria_id", referencedColumnName: "id")]
    private $carroceria;

    #[ORM\ManyToOne(targetEntity: Ciudad::class, inversedBy: 'solicitudesCiudadOrigen')]
    #[ORM\JoinColumn(name: "ciudad_origen_id", referencedColumnName: "id")]
    private $ciudadOrigen;

    #[ORM\ManyToOne(targetEntity: Ciudad::class, inversedBy: 'solicitudesCiudadDestino')]
    #[ORM\JoinColumn(name: "ciudad_destino_id", referencedColumnName: "id")]
    private $ciudadDestino;

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

    /**
     * @return mixed
     */
    public function getCiudadOrigenId()
    {
        return $this->ciudadOrigenId;
    }

    /**
     * @param mixed $ciudadOrigenId
     */
    public function setCiudadOrigenId($ciudadOrigenId): void
    {
        $this->ciudadOrigenId = $ciudadOrigenId;
    }

    /**
     * @return mixed
     */
    public function getCiudadDestinoId()
    {
        return $this->ciudadDestinoId;
    }

    /**
     * @param mixed $ciudadDestinoId
     */
    public function setCiudadDestinoId($ciudadDestinoId): void
    {
        $this->ciudadDestinoId = $ciudadDestinoId;
    }

    /**
     * @return float
     */
    public function getPrecio(): float
    {
        return $this->precio;
    }

    /**
     * @param float $precio
     */
    public function setPrecio(float $precio): void
    {
        $this->precio = $precio;
    }

    /**
     * @return float
     */
    public function getPeso(): float
    {
        return $this->peso;
    }

    /**
     * @param float $peso
     */
    public function setPeso(float $peso): void
    {
        $this->peso = $peso;
    }

    /**
     * @return float
     */
    public function getVolumen(): float
    {
        return $this->volumen;
    }

    /**
     * @param float $volumen
     */
    public function setVolumen(float $volumen): void
    {
        $this->volumen = $volumen;
    }

    /**
     * @return int
     */
    public function getEntregas(): int
    {
        return $this->entregas;
    }

    /**
     * @param int $entregas
     */
    public function setEntregas(int $entregas): void
    {
        $this->entregas = $entregas;
    }

    /**
     * @return mixed
     */
    public function getCarroceriaId()
    {
        return $this->carroceriaId;
    }

    /**
     * @param mixed $carroceriaId
     */
    public function setCarroceriaId($carroceriaId): void
    {
        $this->carroceriaId = $carroceriaId;
    }

    /**
     * @return mixed
     */
    public function getCarroceria()
    {
        return $this->carroceria;
    }

    /**
     * @param mixed $carroceria
     */
    public function setCarroceria($carroceria): void
    {
        $this->carroceria = $carroceria;
    }

    /**
     * @return mixed
     */
    public function getCiudadOrigen()
    {
        return $this->ciudadOrigen;
    }

    /**
     * @param mixed $ciudadOrigen
     */
    public function setCiudadOrigen($ciudadOrigen): void
    {
        $this->ciudadOrigen = $ciudadOrigen;
    }

    /**
     * @return mixed
     */
    public function getCiudadDestino()
    {
        return $this->ciudadDestino;
    }

    /**
     * @param mixed $ciudadDestino
     */
    public function setCiudadDestino($ciudadDestino): void
    {
        $this->ciudadDestino = $ciudadDestino;
    }



}
