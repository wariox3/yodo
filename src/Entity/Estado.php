<?php


namespace App\Entity;

use App\Repository\EstadoRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EstadoRepository::class)]
class Estado
{
    #[ORM\Id]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 80)]
    private ?string $nombre = null;

    #[ORM\Column(type: "integer")]
    private $paisId;

    #[ORM\Column(length: 10)]
    private ?string $codigoDane = null;

    #[ORM\ManyToOne(targetEntity: Pais::class, inversedBy: 'estados')]
    #[ORM\JoinColumn(name: "pais_id", referencedColumnName: "id")]
    private $pais;

    #[ORM\OneToMany(targetEntity: Ciudad::class, mappedBy: 'estado')]
    private Collection $ciudades;

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
    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    /**
     * @param string|null $nombre
     */
    public function setNombre(?string $nombre): void
    {
        $this->nombre = $nombre;
    }

    /**
     * @return mixed
     */
    public function getPaisId()
    {
        return $this->paisId;
    }

    /**
     * @param mixed $paisId
     */
    public function setPaisId($paisId): void
    {
        $this->paisId = $paisId;
    }

    /**
     * @return string|null
     */
    public function getCodigoDane(): ?string
    {
        return $this->codigoDane;
    }

    /**
     * @param string|null $codigoDane
     */
    public function setCodigoDane(?string $codigoDane): void
    {
        $this->codigoDane = $codigoDane;
    }

    /**
     * @return mixed
     */
    public function getPais()
    {
        return $this->pais;
    }

    /**
     * @param mixed $pais
     */
    public function setPais($pais): void
    {
        $this->pais = $pais;
    }

    /**
     * @return Collection
     */
    public function getCiudades(): Collection
    {
        return $this->ciudades;
    }

    /**
     * @param Collection $ciudades
     */
    public function setCiudades(Collection $ciudades): void
    {
        $this->ciudades = $ciudades;
    }



}

