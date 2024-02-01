<?php

namespace App\Entity;

use App\Repository\ConductorRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ConductorRepository::class)]
class Conductor
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: 'string', length: 150)]
    private $nombre = null;

    #[ORM\Column(type: 'string', length: 20, nullable: true)]
    private $numeroIdentificacion;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $fechaNacimiento;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $alias = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): static
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getNumeroIdentificacion(): ?string
    {
        return $this->numeroIdentificacion;
    }

    public function setNumeroIdentificacion(?string $numeroIdentificacion): static
    {
        $this->numeroIdentificacion = $numeroIdentificacion;

        return $this;
    }

    public function getFechaNacimiento(): ?\DateTimeInterface
    {
        return $this->fechaNacimiento;
    }

    public function setFechaNacimiento(?\DateTimeInterface $fechaNacimiento): static
    {
        $this->fechaNacimiento = $fechaNacimiento;

        return $this;
    }

    public function getAlias(): ?string
    {
        return $this->alias;
    }

    public function setAlias(?string $alias): static
    {
        $this->alias = $alias;

        return $this;
    }
}
