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

}
