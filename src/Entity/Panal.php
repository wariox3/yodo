<?php


namespace App\Entity;

use App\Repository\PanalRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PanalRepository::class)]
class Panal
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $nombre = null;

    #[ORM\Column(length: 100)]
    private ?string $correo = null;

    #[ORM\Column(length: 300)]
    private ?string $direccion = null;

    #[ORM\OneToMany(targetEntity: Celda::class, mappedBy: 'panal')]
    private Collection $celdas;

    #[ORM\OneToMany(targetEntity: Usuario::class, mappedBy: 'panal')]
    private Collection $usuarios;

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
    public function getCorreo(): ?string
    {
        return $this->correo;
    }

    /**
     * @param string|null $correo
     */
    public function setCorreo(?string $correo): void
    {
        $this->correo = $correo;
    }

    /**
     * @return string|null
     */
    public function getDireccion(): ?string
    {
        return $this->direccion;
    }

    /**
     * @param string|null $direccion
     */
    public function setDireccion(?string $direccion): void
    {
        $this->direccion = $direccion;
    }

    /**
     * @return Collection
     */
    public function getCeldas(): Collection
    {
        return $this->celdas;
    }

    /**
     * @param Collection $celdas
     */
    public function setCeldas(Collection $celdas): void
    {
        $this->celdas = $celdas;
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



}

