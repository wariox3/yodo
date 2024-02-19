<?php

namespace App\Entity;

use App\Repository\CasoRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CasoRepository::class)]
class Caso
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: "datetime", nullable: true)]
    private $fecha = null;

    #[ORM\Column(type: "datetime", nullable: true)]
    private $fechaAtendido = null;

    #[ORM\Column(type: "datetime", nullable: true)]
    private $fechaCerrado = null;

    #[ORM\Column(type:"text", nullable: true)]
    private string $descripcion;

    #[ORM\Column(type:"string", length: 200)]
    private $nombre;

    #[ORM\Column(type:"string", length: 200)]
    private $correo;

    #[ORM\Column(type: "string", length: 200, nullable: true)]
    private $celular;

    #[ORM\Column(type: "boolean", options: ["default" => false])]
    private $estadoAtendido = false;

    #[ORM\Column(type: "boolean", options: ["default" => false])]
    private $estadoCerrado = false;

    #[ORM\ManyToOne(targetEntity: CasoTipo::class, inversedBy: 'casos')]
    #[ORM\JoinColumn(name: "caso_tipo_id", referencedColumnName: "id")]
    private $casoTipo;

    #[ORM\ManyToOne(targetEntity: Panal::class, inversedBy: 'casos')]
    #[ORM\JoinColumn(name: "panal_id", referencedColumnName: "id")]
    private $panal;

    #[ORM\ManyToOne(targetEntity: Usuario::class, inversedBy: 'casos')]
    #[ORM\JoinColumn(name: "usuario_id", referencedColumnName: "id")]
    private $usuario;

    public function getId(): ?int
    {
        return $this->id;
    }

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
    public function getFechaAtendido()
    {
        return $this->fechaAtendido;
    }

    /**
     * @param null $fechaAtendido
     */
    public function setFechaAtendido($fechaAtendido): void
    {
        $this->fechaAtendido = $fechaAtendido;
    }

    /**
     * @return null
     */
    public function getFechaCerrado()
    {
        return $this->fechaCerrado;
    }

    /**
     * @param null $fechaCerrado
     */
    public function setFechaCerrado($fechaCerrado): void
    {
        $this->fechaCerrado = $fechaCerrado;
    }

    public function getDescripcion(): string
    {
        return $this->descripcion;
    }

    public function setDescripcion(string $descripcion): void
    {
        $this->descripcion = $descripcion;
    }

    /**
     * @return mixed
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * @param mixed $nombre
     */
    public function setNombre($nombre): void
    {
        $this->nombre = $nombre;
    }

    /**
     * @return mixed
     */
    public function getCorreo()
    {
        return $this->correo;
    }

    /**
     * @param mixed $correo
     */
    public function setCorreo($correo): void
    {
        $this->correo = $correo;
    }

    /**
     * @return mixed
     */
    public function getCelular()
    {
        return $this->celular;
    }

    /**
     * @param mixed $celular
     */
    public function setCelular($celular): void
    {
        $this->celular = $celular;
    }

    public function isEstadoAtendido(): bool
    {
        return $this->estadoAtendido;
    }

    public function setEstadoAtendido(bool $estadoAtendido): void
    {
        $this->estadoAtendido = $estadoAtendido;
    }

    public function isEstadoCerrado(): bool
    {
        return $this->estadoCerrado;
    }

    public function setEstadoCerrado(bool $estadoCerrado): void
    {
        $this->estadoCerrado = $estadoCerrado;
    }

    /**
     * @return mixed
     */
    public function getCasoTipo()
    {
        return $this->casoTipo;
    }

    /**
     * @param mixed $casoTipo
     */
    public function setCasoTipo($casoTipo): void
    {
        $this->casoTipo = $casoTipo;
    }

    /**
     * @return mixed
     */
    public function getPanal()
    {
        return $this->panal;
    }

    /**
     * @param mixed $panal
     */
    public function setPanal($panal): void
    {
        $this->panal = $panal;
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
