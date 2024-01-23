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

    #[ORM\Column(length: 80)]
    private ?string $nombre = null;

    #[ORM\Column(type: "integer", nullable: true)]
    private $estadoId;

    #[ORM\ManyToOne(targetEntity: Estado::class, inversedBy: 'ciudades')]
    #[ORM\JoinColumn(name: "estado_id", referencedColumnName: "id")]
    private $estado;

    #[ORM\OneToMany(targetEntity: Ciudad::class, mappedBy: 'ciudad')]
    private Collection $usuarios;

    #[ORM\OneToMany(targetEntity: Ciudad::class, mappedBy: 'ciudad')]
    private Collection $panales;

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


}

