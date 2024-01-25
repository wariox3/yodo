<?php


namespace App\Entity;

use App\Repository\CeldaUsuarioRepository;
use App\Repository\EntregaRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EntregaRepository::class)]
class Entrega
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: "integer")]
    private $celdaId;

    #[ORM\Column(type: "integer")]
    private $entregaTipoId;

    #[ORM\Column(type: "datetime")]
    private $fechaIngreso;

    #[ORM\Column(type: "datetime")]
    private $fechaEntrega;

    #[ORM\Column(type:"string", length: 200)]
    private ?string $descripcion;

    #[ORM\Column(type:"string", length: 250)]
    private ?string $urlImagenIngreso;

    #[ORM\Column(type: "boolean", options: ["default" => false])]
    private $estadoEntregado = false;

    #[ORM\ManyToOne(targetEntity: EntregaTipo::class, inversedBy: 'entregas')]
    #[ORM\JoinColumn(name: "entrega_tipo_id", referencedColumnName: "id")]
    private $entregaTipo;

    #[ORM\ManyToOne(targetEntity: Celda::class, inversedBy: 'entregas')]
    #[ORM\JoinColumn(name: "celda_id", referencedColumnName: "id")]
    private $celda;

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
    public function getCeldaId()
    {
        return $this->celdaId;
    }

    /**
     * @param mixed $celdaId
     */
    public function setCeldaId($celdaId): void
    {
        $this->celdaId = $celdaId;
    }

    /**
     * @return mixed
     */
    public function getEntregaTipoId()
    {
        return $this->entregaTipoId;
    }

    /**
     * @param mixed $entregaTipoId
     */
    public function setEntregaTipoId($entregaTipoId): void
    {
        $this->entregaTipoId = $entregaTipoId;
    }

    /**
     * @return mixed
     */
    public function getFechaIngreso()
    {
        return $this->fechaIngreso;
    }

    /**
     * @param mixed $fechaIngreso
     */
    public function setFechaIngreso($fechaIngreso): void
    {
        $this->fechaIngreso = $fechaIngreso;
    }

    /**
     * @return mixed
     */
    public function getFechaEntrega()
    {
        return $this->fechaEntrega;
    }

    /**
     * @param mixed $fechaEntrega
     */
    public function setFechaEntrega($fechaEntrega): void
    {
        $this->fechaEntrega = $fechaEntrega;
    }

    /**
     * @return string|null
     */
    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    /**
     * @param string|null $descripcion
     */
    public function setDescripcion(?string $descripcion): void
    {
        $this->descripcion = $descripcion;
    }

    /**
     * @return string|null
     */
    public function getUrlImagenIngreso(): ?string
    {
        return $this->urlImagenIngreso;
    }

    /**
     * @param string|null $urlImagenIngreso
     */
    public function setUrlImagenIngreso(?string $urlImagenIngreso): void
    {
        $this->urlImagenIngreso = $urlImagenIngreso;
    }

    /**
     * @return bool
     */
    public function isEstadoEntregado(): bool
    {
        return $this->estadoEntregado;
    }

    /**
     * @param bool $estadoEntregado
     */
    public function setEstadoEntregado(bool $estadoEntregado): void
    {
        $this->estadoEntregado = $estadoEntregado;
    }

    /**
     * @return mixed
     */
    public function getEntregaTipo()
    {
        return $this->entregaTipo;
    }

    /**
     * @param mixed $entregaTipo
     */
    public function setEntregaTipo($entregaTipo): void
    {
        $this->entregaTipo = $entregaTipo;
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

