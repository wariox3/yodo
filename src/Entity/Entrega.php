<?php


namespace App\Entity;

use App\Repository\CeldaUsuarioRepository;
use App\Repository\EntregaRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EntregaRepository::class)]
class Entrega
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: "integer")]
    private $celdaId;

    #[ORM\Column(type: "integer")]
    private $entregaTipoId;

    #[ORM\Column(type: "datetime")]
    private $fechaIngreso;

    #[ORM\Column(type: "datetime")]
    private $fechaEntrega;

    #[ORM\Column(type:"string", length: 200)]
    private ?string $descripcion;

    #[ORM\Column(type:"string", length: 250)]
    private ?string $urlImagenIngreso;

    #[ORM\Column(type: "boolean", options: ["default" => false])]
    private $estadoEntregado = false;

    #[ORM\ManyToOne(targetEntity: EntregaTipo::class, inversedBy: 'entregas')]
    #[ORM\JoinColumn(name: "entrega_tipo_id", referencedColumnName: "id")]
    private $entregaTipo;

    #[ORM\ManyToOne(targetEntity: Celda::class, inversedBy: 'entregas')]
    #[ORM\JoinColumn(name: "celda_id", referencedColumnName: "id")]
    private $celda;

}

