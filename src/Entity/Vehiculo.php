<?php

namespace App\Entity;

use App\Repository\VehiculoRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VehiculoRepository::class)]
class Vehiculo
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: 'integer')]
    private $usuarioId;

    #[ORM\Column(type: 'string', length: 10)]
    private $placa;

    #[ORM\Column(type: 'integer')]
    private $modelo;

    #[ORM\Column(type: 'integer', options: ["default" => 0])]
    private $numeroEjes;

    #[ORM\Column(type: 'integer', options: ["default" => 0])]
    private $capacidad = 0;

    #[ORM\Column(type: 'integer', options: ["default" => 0])]
    private $pesoVacio = 0;

    #[ORM\Column(type: 'integer')]
    private $marcaId;

    #[ORM\Column(type: 'integer')]
    private $lineaId;

    #[ORM\Column(type: 'integer')]
    private $carroceriaId;

    #[ORM\Column(type: 'integer')]
    private $combustibleId;

    #[ORM\Column(type: 'integer')]
    private $configuracionId;

    #[ORM\Column(type: 'string', length: 30)]
    private $numeroPoliza;

    #[ORM\Column(type: "date")]
    private $vigenciaPoliza;

    #[ORM\Column(type: "date")]
    private $vigenciaRevisionTecnica;

    #[ORM\ManyToOne(targetEntity: Usuario::class, inversedBy: 'vehiculos')]
    #[ORM\JoinColumn(name: "usuario_id", referencedColumnName: "id")]
    private $usuario;

    #[ORM\ManyToOne(targetEntity: Marca::class, inversedBy: 'vehiculos')]
    #[ORM\JoinColumn(name: "marca_id", referencedColumnName: "id")]
    private $marca;

    #[ORM\ManyToOne(targetEntity: Linea::class, inversedBy: 'vehiculos')]
    #[ORM\JoinColumn(name: "linea_id", referencedColumnName: "id")]
    private $linea;

    #[ORM\ManyToOne(targetEntity: Carroceria::class, inversedBy: 'vehiculos')]
    #[ORM\JoinColumn(name: "carroceria_id", referencedColumnName: "id")]
    private $carroceria;

    #[ORM\ManyToOne(targetEntity: Combustible::class, inversedBy: 'vehiculos')]
    #[ORM\JoinColumn(name: "combustible_id", referencedColumnName: "id")]
    private $combustible;

    #[ORM\ManyToOne(targetEntity: Configuracion::class, inversedBy: 'vehiculos')]
    #[ORM\JoinColumn(name: "configuracion_id", referencedColumnName: "id")]
    private $configuracion;

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
    public function getPlaca()
    {
        return $this->placa;
    }

    /**
     * @param mixed $placa
     */
    public function setPlaca($placa): void
    {
        $this->placa = $placa;
    }

    /**
     * @return mixed
     */
    public function getModelo()
    {
        return $this->modelo;
    }

    /**
     * @param mixed $modelo
     */
    public function setModelo($modelo): void
    {
        $this->modelo = $modelo;
    }

    /**
     * @return mixed
     */
    public function getNumeroEjes()
    {
        return $this->numeroEjes;
    }

    /**
     * @param mixed $numeroEjes
     */
    public function setNumeroEjes($numeroEjes): void
    {
        $this->numeroEjes = $numeroEjes;
    }

    /**
     * @return int
     */
    public function getCapacidad(): int
    {
        return $this->capacidad;
    }

    /**
     * @param int $capacidad
     */
    public function setCapacidad(int $capacidad): void
    {
        $this->capacidad = $capacidad;
    }

    /**
     * @return int
     */
    public function getPesoVacio(): int
    {
        return $this->pesoVacio;
    }

    /**
     * @param int $pesoVacio
     */
    public function setPesoVacio(int $pesoVacio): void
    {
        $this->pesoVacio = $pesoVacio;
    }

    /**
     * @return mixed
     */
    public function getMarcaId()
    {
        return $this->marcaId;
    }

    /**
     * @param mixed $marcaId
     */
    public function setMarcaId($marcaId): void
    {
        $this->marcaId = $marcaId;
    }

    /**
     * @return mixed
     */
    public function getLineaId()
    {
        return $this->lineaId;
    }

    /**
     * @param mixed $lineaId
     */
    public function setLineaId($lineaId): void
    {
        $this->lineaId = $lineaId;
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
    public function getCombustibleId()
    {
        return $this->combustibleId;
    }

    /**
     * @param mixed $combustibleId
     */
    public function setCombustibleId($combustibleId): void
    {
        $this->combustibleId = $combustibleId;
    }

    /**
     * @return mixed
     */
    public function getConfiguracionId()
    {
        return $this->configuracionId;
    }

    /**
     * @param mixed $configuracionId
     */
    public function setConfiguracionId($configuracionId): void
    {
        $this->configuracionId = $configuracionId;
    }

    /**
     * @return mixed
     */
    public function getNumeroPoliza()
    {
        return $this->numeroPoliza;
    }

    /**
     * @param mixed $numeroPoliza
     */
    public function setNumeroPoliza($numeroPoliza): void
    {
        $this->numeroPoliza = $numeroPoliza;
    }

    /**
     * @return mixed
     */
    public function getVigenciaPoliza()
    {
        return $this->vigenciaPoliza;
    }

    /**
     * @param mixed $vigenciaPoliza
     */
    public function setVigenciaPoliza($vigenciaPoliza): void
    {
        $this->vigenciaPoliza = $vigenciaPoliza;
    }

    /**
     * @return mixed
     */
    public function getVigenciaRevisionTecnica()
    {
        return $this->vigenciaRevisionTecnica;
    }

    /**
     * @param mixed $vigenciaRevisionTecnica
     */
    public function setVigenciaRevisionTecnica($vigenciaRevisionTecnica): void
    {
        $this->vigenciaRevisionTecnica = $vigenciaRevisionTecnica;
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
    public function getMarca()
    {
        return $this->marca;
    }

    /**
     * @param mixed $marca
     */
    public function setMarca($marca): void
    {
        $this->marca = $marca;
    }

    /**
     * @return mixed
     */
    public function getLinea()
    {
        return $this->linea;
    }

    /**
     * @param mixed $linea
     */
    public function setLinea($linea): void
    {
        $this->linea = $linea;
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
    public function getCombustible()
    {
        return $this->combustible;
    }

    /**
     * @param mixed $combustible
     */
    public function setCombustible($combustible): void
    {
        $this->combustible = $combustible;
    }

    /**
     * @return mixed
     */
    public function getConfiguracion()
    {
        return $this->configuracion;
    }

    /**
     * @param mixed $configuracion
     */
    public function setConfiguracion($configuracion): void
    {
        $this->configuracion = $configuracion;
    }


}
