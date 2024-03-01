<?php

namespace App\Entity;

use App\Repository\CambioClaveRepository;
use App\Repository\CasoRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CambioClaveRepository::class)]
class CambioClave
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: "datetime")]
    private $fecha = null;

    #[ORM\Column(type: "integer")]
    private $codigo = 0;

    #[ORM\Column(type: "integer")]
    private $usuarioId;

    #[ORM\Column(type: "boolean", options: ["default" => false])]
    private $estadoAplicado = false;

    #[ORM\ManyToOne(targetEntity: Usuario::class, inversedBy: 'cambiosClave')]
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

    public function getCodigo(): int
    {
        return $this->codigo;
    }

    public function setCodigo(int $codigo): void
    {
        $this->codigo = $codigo;
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

    public function isEstadoAplicado(): bool
    {
        return $this->estadoAplicado;
    }

    public function setEstadoAplicado(bool $estadoAplicado): void
    {
        $this->estadoAplicado = $estadoAplicado;
    }



}
