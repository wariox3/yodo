<?php


namespace App\Entity;

use App\Repository\CarroceriaRepository;
use App\Repository\ConfiguracionRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ConfiguracionRepository::class)]
class Configuracion
{
    #[ORM\Id]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: 'integer')]
    private $codigo;

    #[ORM\Column(length: 20)]
    private ?string $nombre = null;

    #[ORM\Column(length: 100)]
    private ?string $descripcion = null;
    #[ORM\Column(length: 50)]
    private ?string $tipo = null;

    #[ORM\Column(type: 'integer', options: ["default" => 0])]
    private $pesoMinimo = 0;

    #[ORM\Column(type: 'integer', options: ["default" => 0])]
    private $pesoMaximo = 0;

    #[ORM\OneToMany(targetEntity: Vehiculo::class, mappedBy: 'configuracion')]
    private Collection $vehiculos;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getCodigo()
    {
        return $this->codigo;
    }

    /**
     * @param mixed $codigo
     */
    public function setCodigo($codigo): void
    {
        $this->codigo = $codigo;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(?string $nombre): void
    {
        $this->nombre = $nombre;
    }

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(?string $descripcion): void
    {
        $this->descripcion = $descripcion;
    }

    public function getTipo(): ?string
    {
        return $this->tipo;
    }

    public function setTipo(?string $tipo): void
    {
        $this->tipo = $tipo;
    }

    public function getPesoMinimo(): int
    {
        return $this->pesoMinimo;
    }

    public function setPesoMinimo(int $pesoMinimo): void
    {
        $this->pesoMinimo = $pesoMinimo;
    }

    public function getPesoMaximo(): int
    {
        return $this->pesoMaximo;
    }

    public function setPesoMaximo(int $pesoMaximo): void
    {
        $this->pesoMaximo = $pesoMaximo;
    }

    public function getVehiculos(): Collection
    {
        return $this->vehiculos;
    }

    public function setVehiculos(Collection $vehiculos): void
    {
        $this->vehiculos = $vehiculos;
    }


}

