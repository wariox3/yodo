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

    #[ORM\OneToMany(targetEntity: Usuario::class, mappedBy: 'celda')]
    private Collection $usuarios;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     */
    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string|null
     */
    public function getCelda(): ?string
    {
        return $this->celda;
    }

    /**
     * @param string|null $celda
     */
    public function setCelda(?string $celda): void
    {
        $this->celda = $celda;
    }

    /**
     * @return Category
     */
    public function getPanal(): Category
    {
        return $this->panal;
    }

    /**
     * @param Category $panal
     */
    public function setPanal(Category $panal): void
    {
        $this->panal = $panal;
    }

    /**
     * @return Collection
     */
    public function getUsuarios(): Collection
    {
        return $this->usuarios;
    }

    /**
     * @param Collection $usuarios
     */
    public function setUsuarios(Collection $usuarios): void
    {
        $this->usuarios = $usuarios;
    }


}

