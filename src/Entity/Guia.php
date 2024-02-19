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
     * @return mixed
     */
    public function getDespachoId()
    {
        return $this->despachoId;
    }

    /**
     * @param mixed $despachoId
     */
    public function setDespachoId($despachoId): void
    {
        $this->despachoId = $despachoId;
    }

    /**
     * @return mixed
     */
    public function getDespacho()
    {
        return $this->despacho;
    }

    /**
     * @param mixed $despacho
     */
    public function setDespacho($despacho): void
    {
        $this->despacho = $despacho;
    }


}
