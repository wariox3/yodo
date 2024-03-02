<?php


namespace App\Entity;

use App\Repository\CiudadRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CiudadRepository::class)]
class Ciudad
{
    #[ORM\Id]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $nombre = null;

    #[ORM\Column(length: 10)]
    private ?string $codigoDane = null;

    #[ORM\Column(length: 10)]
    private ?string $codigoPostal = null;

    #[ORM\Column(type: "integer")]
    private $estadoId;

    #[ORM\ManyToOne(targetEntity: Estado::class, inversedBy: 'ciudades')]
    #[ORM\JoinColumn(name: "estado_id", referencedColumnName: "id")]
    private $estado;

    #[ORM\OneToMany(targetEntity: Usuario::class, mappedBy: 'ciudad')]
    private Collection $usuarios;

    #[ORM\OneToMany(targetEntity: Panal::class, mappedBy: 'ciudad')]
    private Collection $panales;

    #[ORM\OneToMany(targetEntity: Solicitud::class, mappedBy: 'ciudadOrigen')]
    private Collection $solicitudesCiudadOrigen;

    #[ORM\OneToMany(targetEntity: Solicitud::class, mappedBy: 'ciudadDestino')]
    private Collection $solicitudesCiudadDestino;

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
     * @return string|null
     */
    public function getCodigoDane(): ?string
    {
        return $this->codigoDane;
    }

    /**
     * @param string|null $codigoDane
     */
    public function setCodigoDane(?string $codigoDane): void
    {
        $this->codigoDane = $codigoDane;
    }

    /**
     * @return string|null
     */
    public function getCodigoPostal(): ?string
    {
        return $this->codigoPostal;
    }

    /**
     * @param string|null $codigoPostal
     */
    public function setCodigoPostal(?string $codigoPostal): void
    {
        $this->codigoPostal = $codigoPostal;
    }

    /**
     * @return mixed
     */
    public function getEstadoId()
    {
        return $this->estadoId;
    }

    /**
     * @param mixed $estadoId
     */
    public function setEstadoId($estadoId): void
    {
        $this->estadoId = $estadoId;
    }

    /**
     * @return mixed
     */
    public function getEstado()
    {
        return $this->estado;
    }

    /**
     * @param mixed $estado
     */
    public function setEstado($estado): void
    {
        $this->estado = $estado;
    }

    /**
     * @return Collection
     */
    public function getUsuarios(): Collection
    {
        return $this->usuarios;
    }

    /**
     * @param Collection $usuarios
     */
    public function setUsuarios(Collection $usuarios): void
    {
        $this->usuarios = $usuarios;
    }

    /**
     * @return Collection
     */
    public function getPanales(): Collection
    {
        return $this->panales;
    }

    /**
     * @param Collection $panales
     */
    public function setPanales(Collection $panales): void
    {
        $this->panales = $panales;
    }

    /**
     * @return Collection
     */
    public function getSolicitudesCiudadOrigen(): Collection
    {
        return $this->solicitudesCiudadOrigen;
    }

    /**
     * @param Collection $solicitudesCiudadOrigen
     */
    public function setSolicitudesCiudadOrigen(Collection $solicitudesCiudadOrigen): void
    {
        $this->solicitudesCiudadOrigen = $solicitudesCiudadOrigen;
    }

    /**
     * @return Collection
     */
    public function getSolicitudesCiudadDestino(): Collection
    {
        return $this->solicitudesCiudadDestino;
    }

    /**
     * @param Collection $solicitudesCiudadDestino
     */
    public function setSolicitudesCiudadDestino(Collection $solicitudesCiudadDestino): void
    {
        $this->solicitudesCiudadDestino = $solicitudesCiudadDestino;
    }





}

