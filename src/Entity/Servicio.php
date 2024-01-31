<?php

namespace App\Entity;

use App\Repository\AtencionRepository;
use App\Repository\ServicioRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ServicioRepository::class)]
class Servicio
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: "datetime")]
    private $fecha = null;

    #[ORM\Column(length: 200, nullable: true)]
    private $descripcion = null;

    #[ORM\Column(type: "boolean", options: ["default" => false])]
    private $estadoAsignado = false;

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




}
