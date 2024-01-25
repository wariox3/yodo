<?php


namespace App\Entity;

use App\Repository\CeldaUsuarioRepository;
use App\Repository\EntregaRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EntregaRepository::class)]
class Visita
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: "datetime")]
    private $fecha;

    #[ORM\Column(type:"string", length: 30, nullable: true)]
    private ?string $numeroIdentificacion;

    #[ORM\Column(type:"string", length: 150, nullable: true)]
    private ?string $nombre;

    #[ORM\Column(type:"string", length: 10, nullable: true)]
    private ?string $placa;

    #[ORM\Column(type: "integer")]
    private $celdaId;

    #[ORM\Column(type: "integer")]
    private $panalId;

    #[ORM\Column(type: "integer", nullable: true)]
    private $usuarioAutorizaId;

    #[ORM\Column(type:"string", length: 10, nullable: true)]
    private ?string $codigoIngreso;

    #[ORM\Column(type:"string", length: 250)]
    private ?string $urlImagenIngreso;

    #[ORM\Column(type: "boolean", options: ["default" => false])]
    private $estadoAutorizado = false;

    #[ORM\ManyToOne(targetEntity: Celda::class, inversedBy: 'visitas')]
    #[ORM\JoinColumn(name: "celda_id", referencedColumnName: "id")]
    private $celda;

    #[ORM\ManyToOne(targetEntity: Panal::class, inversedBy: 'visitas')]
    #[ORM\JoinColumn(name: "panal_id", referencedColumnName: "id")]
    private $panal;

    #[ORM\ManyToOne(targetEntity: Usuario::class, inversedBy: 'visitas')]
    #[ORM\JoinColumn(name: "usuario_autoriza_id", referencedColumnName: "id")]
    private $usuarioAutoriza;

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
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * @param mixed $fecha
     */
    public function setFecha($fecha): void
    {
        $this->fecha = $fecha;
    }

    /**
     * @return string|null
     */
    public function getNumeroIdentificacion(): ?string
    {
        return $this->numeroIdentificacion;
    }

    /**
     * @param string|null $numeroIdentificacion
     */
    public function setNumeroIdentificacion(?string $numeroIdentificacion): void
    {
        $this->numeroIdentificacion = $numeroIdentificacion;
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
     * @return string|null
     */
    public function getPlaca(): ?string
    {
        return $this->placa;
    }

    /**
     * @param string|null $placa
     */
    public function setPlaca(?string $placa): void
    {
        $this->placa = $placa;
    }

    /**
     * @return mixed
     */
    public function getCeldaId()
    {
        return $this->celdaId;
    }

    /**
     * @param mixed $celdaId
     */
    public function setCeldaId($celdaId): void
    {
        $this->celdaId = $celdaId;
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
    public function getUsuarioAutorizaId()
    {
        return $this->usuarioAutorizaId;
    }

    /**
     * @param mixed $usuarioAutorizaId
     */
    public function setUsuarioAutorizaId($usuarioAutorizaId): void
    {
        $this->usuarioAutorizaId = $usuarioAutorizaId;
    }

    /**
     * @return string|null
     */
    public function getCodigoIngreso(): ?string
    {
        return $this->codigoIngreso;
    }

    /**
     * @param string|null $codigoIngreso
     */
    public function setCodigoIngreso(?string $codigoIngreso): void
    {
        $this->codigoIngreso = $codigoIngreso;
    }

    /**
     * @return string|null
     */
    public function getUrlImagenIngreso(): ?string
    {
        return $this->urlImagenIngreso;
    }

    /**
     * @param string|null $urlImagenIngreso
     */
    public function setUrlImagenIngreso(?string $urlImagenIngreso): void
    {
        $this->urlImagenIngreso = $urlImagenIngreso;
    }

    /**
     * @return bool
     */
    public function isEstadoAutorizado(): bool
    {
        return $this->estadoAutorizado;
    }

    /**
     * @param bool $estadoAutorizado
     */
    public function setEstadoAutorizado(bool $estadoAutorizado): void
    {
        $this->estadoAutorizado = $estadoAutorizado;
    }

    /**
     * @return mixed
     */
    public function getCelda()
    {
        return $this->celda;
    }

    /**
     * @param mixed $celda
     */
    public function setCelda($celda): void
    {
        $this->celda = $celda;
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
     * @return mixed
     */
    public function getUsuarioAutoriza()
    {
        return $this->usuarioAutoriza;
    }

    /**
     * @param mixed $usuarioAutoriza
     */
    public function setUsuarioAutoriza($usuarioAutoriza): void
    {
        $this->usuarioAutoriza = $usuarioAutoriza;
    }


}

