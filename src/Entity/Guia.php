<?php

namespace App\Entity;

use App\Repository\GuiaRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GuiaRepository::class)]
class Guia
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: "integer")]
    private $despachoId;

    #[ORM\ManyToOne(targetEntity: Despacho::class, inversedBy: 'guias')]
    #[ORM\JoinColumn(name: "despacho_id", referencedColumnName: "id")]
    private $despacho;
}
