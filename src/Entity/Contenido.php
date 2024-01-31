<?php

namespace App\Entity;

use App\Repository\ContenidoRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ContenidoRepository::class)]
class Contenido
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: "string", length: 200, nullable: true)]
    private $nombre;

    #[ORM\Column(type:"string", length: 200,  nullable: true)]
    private $nombreArchivo;

    #[ORM\Column(type:"string", length: 500,  nullable: true)]
    private $url;

    #[ORM\ManyToOne(targetEntity: Panal::class, inversedBy: 'contenidos')]
    #[ORM\JoinColumn(name: "panal_id", referencedColumnName: "id")]
    private $panal;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(?string $nombre): static
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getNombreArchivo(): ?string
    {
        return $this->nombreArchivo;
    }

    public function setNombreArchivo(?string $nombreArchivo): static
    {
        $this->nombreArchivo = $nombreArchivo;

        return $this;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(?string $url): static
    {
        $this->url = $url;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getPanal()
    {
        return $this->panal;
    }

    /**
     * @param mixed $panal
     */
    public function setPanal($panal): void
    {
        $this->panal = $panal;
    }


}
