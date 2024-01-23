<?php


namespace App\Entity;

use App\Repository\CeldaRepository;
use App\Repository\PanalRepository;
use Doctrine\Common\Collections\Collection;
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

    #[ORM\Column(length: 200, nullable: true)]
    private ?string $responsable = null;

    #[ORM\Column(length: 20, nullable: true)]
    private ?string $celular = null;

    #[ORM\Column(length: 150, nullable: true)]
    private ?string $correo = null;

    #[ORM\Column(length: 200, nullable: true)]
    private ?string $llave = null;

    #[ORM\Column(type: "integer", nullable: true)]
    private $panalId;

    #[ORM\ManyToOne(targetEntity: Panal::class, inversedBy: 'celdas')]
    #[ORM\JoinColumn(name: "panal_id", referencedColumnName: "id")]
    private $panal;

    #[ORM\OneToMany(targetEntity: Usuario::class, mappedBy: 'celda')]
    private Collection $usuarios;

    #[ORM\OneToMany(targetEntity: CeldaUsuario::class, mappedBy: 'celda')]
    private Collection $celdasUsuarios;

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

    /**
     * @return mixed
     */
    public function getPanalId()
    {
        return $this->panalId;
    }

    /**
     * @param mixed $panalId
     */
    public function setPanalId($panalId): void
    {
        $this->panalId = $panalId;
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

    /**
     * @return Collection
     */
    public function getCeldasUsuarios(): Collection
    {
        return $this->celdasUsuarios;
    }

    /**
     * @param Collection $celdasUsuarios
     */
    public function setCeldasUsuarios(Collection $celdasUsuarios): void
    {
        $this->celdasUsuarios = $celdasUsuarios;
    }

    /**
     * @return string|null
     */
    public function getResponsable(): ?string
    {
        return $this->responsable;
    }

    /**
     * @param string|null $responsable
     */
    public function setResponsable(?string $responsable): void
    {
        $this->responsable = $responsable;
    }

    /**
     * @return string|null
     */
    public function getCelular(): ?string
    {
        return $this->celular;
    }

    /**
     * @param string|null $celular
     */
    public function setCelular(?string $celular): void
    {
        $this->celular = $celular;
    }

    /**
     * @return string|null
     */
    public function getCorreo(): ?string
    {
        return $this->correo;
    }

    /**
     * @param string|null $correo
     */
    public function setCorreo(?string $correo): void
    {
        $this->correo = $correo;
    }

    /**
     * @return string|null
     */
    public function getLlave(): ?string
    {
        return $this->llave;
    }

    /**
     * @param string|null $llave
     */
    public function setLlave(?string $llave): void
    {
        $this->llave = $llave;
    }


}

