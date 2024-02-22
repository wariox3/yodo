<?php


namespace App\Entity;

use App\Repository\ArchivoRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ArchivoRepository::class)]
class Archivo
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: "integer")]
    private $archivoTipoId;

    #[ORM\Column(type: "integer")]
    private $codigo;

    #[ORM\Column(length: 50)]
    private ?string $directorio = null;

    #[ORM\Column(length: 254)]
    private ?string $nombre = null;

    #[ORM\Column(length: 50)]
    private ?string $contentType = null;

    #[ORM\Column(name: "tamano", type: "float", options: ["default" => 0])]
    private $tamano = 0.0;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getArchivoTipoId()
    {
        return $this->archivoTipoId;
    }

    /**
     * @param mixed $archivoTipoId
     */
    public function setArchivoTipoId($archivoTipoId): void
    {
        $this->archivoTipoId = $archivoTipoId;
    }

    /**
     * @return mixed
     */
    public function getCodigo()
    {
        return $this->codigo;
    }

    /**
     * @param mixed $codigo
     */
    public function setCodigo($codigo): void
    {
        $this->codigo = $codigo;
    }

    public function getDirectorio(): ?string
    {
        return $this->directorio;
    }

    public function setDirectorio(?string $directorio): void
    {
        $this->directorio = $directorio;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(?string $nombre): void
    {
        $this->nombre = $nombre;
    }

    public function getContentType(): ?string
    {
        return $this->contentType;
    }

    public function setContentType(?string $contentType): void
    {
        $this->contentType = $contentType;
    }

    public function getTamano(): float
    {
        return $this->tamano;
    }

    public function setTamano(float $tamano): void
    {
        $this->tamano = $tamano;
    }


}

