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
}

