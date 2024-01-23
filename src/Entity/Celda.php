<?php


namespace App\Entity;

use App\Repository\CeldaRepository;
use App\Repository\PanalRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CeldaRepository::class)]
class Celda
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 20)]
    private ?string $celda = null;

    #[ORM\ManyToOne(targetEntity: Panal::class, inversedBy: 'celdas')]
    private Category $panal;
}

