<?php


namespace App\Entity;

use App\Repository\CarroceriaRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CarroceriaRepository::class)]
class Carroceria
{
    #[ORM\Id]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $nombre = null;

    #[ORM\OneToMany(targetEntity: Vehiculo::class, mappedBy: 'carroceria')]
    private Collection $vehiculos;

}

