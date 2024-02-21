<?php

namespace App\Entity;

use App\Repository\DespachoRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DespachoRepository::class)]
class Despacho
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: "integer")]
    private $operadorId;

    #[ORM\Column(type: "datetime")]
    private $fechaCreacion = null;

    #[ORM\Column(type: "datetime")]
    private $fechaSalida = null;

    #[ORM\Column(type: "integer")]
    private $codigo;

    #[ORM\Column(type: "integer")]
    private $numero;

    #[ORM\Column(type: "integer", nullable: true)]
    private $usuarioId;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $token = null;

    #[ORM\ManyToOne(targetEntity: Operador::class, inversedBy: 'despachos')]
    #[ORM\JoinColumn(name: "operador_id", referencedColumnName: "id")]
    private $operador;

    #[ORM\ManyToOne(targetEntity: Usuario::class, inversedBy: 'despachos')]
    #[ORM\JoinColumn(name: "usuario_id", referencedColumnName: "id")]
    private $usuario;

    #[ORM\OneToMany(targetEntity: Guia::class, mappedBy: 'despacho')]
    private Collection $guias;

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
    public function getOperadorId()
    {
        return $this->operadorId;
    }

    /**
     * @param mixed $operadorId
     */
    public function setOperadorId($operadorId): void
    {
        $this->operadorId = $operadorId;
    }

    /**
     * @return null
     */
    public function getFechaCreacion()
    {
        return $this->fechaCreacion;
    }

    /**
     * @param null $fechaCreacion
     */
    public function setFechaCreacion($fechaCreacion): void
    {
        $this->fechaCreacion = $fechaCreacion;
    }

    /**
     * @return null
     */
    public function getFechaSalida()
    {
        return $this->fechaSalida;
    }

    /**
     * @param null $fechaSalida
     */
    public function setFechaSalida($fechaSalida): void
    {
        $this->fechaSalida = $fechaSalida;
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

    /**
     * @return mixed
     */
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * @param mixed $numero
     */
    public function setNumero($numero): void
    {
        $this->numero = $numero;
    }

    /**
     * @return mixed
     */
    public function getOperador()
    {
        return $this->operador;
    }

    /**
     * @param mixed $operador
     */
    public function setOperador($operador): void
    {
        $this->operador = $operador;
    }

    /**
     * @return Collection
     */
    public function getGuias(): Collection
    {
        return $this->guias;
    }

    /**
     * @param Collection $guias
     */
    public function setGuias(Collection $guias): void
    {
        $this->guias = $guias;
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
     * @return string|null
     */
    public function getToken(): ?string
    {
        return $this->token;
    }

    /**
     * @param string|null $token
     */
    public function setToken(?string $token): void
    {
        $this->token = $token;
    }


}
