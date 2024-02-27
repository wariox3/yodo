<?php


namespace App\Entity;

use App\Repository\CombustibleRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CombustibleRepository::class)]
class Combustible
{
    #[ORM\Id]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $nombre = null;

    #[ORM\OneToMany(targetEntity: Vehiculo::class, mappedBy: 'combustible')]
    private Collection $vehiculos;

}

