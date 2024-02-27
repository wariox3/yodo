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

}

