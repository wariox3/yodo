<?php


namespace App\Entity;

use App\Repository\CeldaUsuarioRepository;
use App\Repository\EntregaRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EntregaRepository::class)]
class Visita
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: "datetime")]
    private $fecha;

    #[ORM\Column(type:"string", length: 30, nullable: true)]
    private ?string $numeroIdentificacion;

    #[ORM\Column(type:"string", length: 150, nullable: true)]
    private ?string $nombre;

    #[ORM\Column(type:"string", length: 10, nullable: true)]
    private ?string $placa;

    #[ORM\Column(type: "integer")]
    private $celdaId;

    #[ORM\Column(type: "integer")]
    private $panalId;

    #[ORM\Column(type: "integer", nullable: true)]
    private $usuarioAutorizaId;

    #[ORM\Column(type:"string", length: 10, nullable: true)]
    private ?string $codigoIngreso;

    #[ORM\Column(type:"string", length: 250)]
    private ?string $urlImagenIngreso;

    #[ORM\Column(type: "boolean", options: ["default" => false])]
    private $estadoAutorizado = false;

    #[ORM\ManyToOne(targetEntity: Celda::class, inversedBy: 'visitas')]
    #[ORM\JoinColumn(name: "celda_id", referencedColumnName: "id")]
    private $celda;

}

