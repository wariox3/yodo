<?php

namespace App\Entity;

use App\Repository\OperadorRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OperadorRepository::class)]
class Operador
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 200)]
    private $nombre;

    #[ORM\Column(type: 'string', length: 200, nullable: true)]
    private $puntoServicio;

    #[ORM\Column(type: 'string', length: 50, nullable: true)]
    private $puntoServicioUsuario;

    #[ORM\Column(type: 'string', length: 50, nullable: true)]
    private $puntoServicioClave;

    #[ORM\OneToMany(targetEntity: Despacho::class, mappedBy: 'operador')]
    private Collection $despachos;

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
     * @return Collection
     */
    public function getDespachos(): Collection
    {
        return $this->despachos;
    }

    /**
     * @param Collection $despachos
     */
    public function setDespachos(Collection $despachos): void
    {
        $this->despachos = $despachos;
    }

    /**
     * @return mixed
     */
    public function getPuntoServicio()
    {
        return $this->puntoServicio;
    }

    /**
     * @param mixed $puntoServicio
     */
    public function setPuntoServicio($puntoServicio): void
    {
        $this->puntoServicio = $puntoServicio;
    }

    /**
     * @return mixed
     */
    public function getPuntoServicioUsuario()
    {
        return $this->puntoServicioUsuario;
    }

    /**
     * @param mixed $puntoServicioUsuario
     */
    public function setPuntoServicioUsuario($puntoServicioUsuario): void
    {
        $this->puntoServicioUsuario = $puntoServicioUsuario;
    }

    /**
     * @return mixed
     */
    public function getPuntoServicioClave()
    {
        return $this->puntoServicioClave;
    }

    /**
     * @param mixed $puntoServicioClave
     */
    public function setPuntoServicioClave($puntoServicioClave): void
    {
        $this->puntoServicioClave = $puntoServicioClave;
    }


}
