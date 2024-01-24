<?php


namespace App\Entity;

use App\Repository\CeldaRepository;
use App\Repository\PanalRepository;
use App\Repository\PublicacionRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PublicacionRepository::class)]
class Publicacion
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: "datetime")]
    private $fecha;

    #[ORM\Column(length: 250, nullable: true)]
    private ?string $descripcion = null;

    #[ORM\Column(length: 250)]
    private ?string $urlImagen = null;

    #[ORM\Column(type: "smallint", options: ["default" => 0])]
    private $reacciones;

    #[ORM\Column(type: "smallint", options: ["default" => 0])]
    private $comentarios;

    #[ORM\Column(type: "boolean", options: ["default" => true])]
    private $estadoAprobado = true;

    #[ORM\Column(type: "boolean", options: ["default" => true])]
    private $permiteComentarios = true;

    #[ORM\Column(type: "integer")]
    private $usuarioId;

    #[ORM\Column(type: "integer")]
    private $panalId;

    #[ORM\ManyToOne(targetEntity: Panal::class, inversedBy: 'publicaciones')]
    #[ORM\JoinColumn(name: "panal_id", referencedColumnName: "id")]
    private $panal;

    #[ORM\ManyToOne(targetEntity: Usuario::class, inversedBy: 'publicaciones')]
    #[ORM\JoinColumn(name: "usuario_id", referencedColumnName: "id")]
    private $usuario;

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
    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    /**
     * @param string|null $descripcion
     */
    public function setDescripcion(?string $descripcion): void
    {
        $this->descripcion = $descripcion;
    }

    /**
     * @return string|null
     */
    public function getUrlImagen(): ?string
    {
        return $this->urlImagen;
    }

    /**
     * @param string|null $urlImagen
     */
    public function setUrlImagen(?string $urlImagen): void
    {
        $this->urlImagen = $urlImagen;
    }

    /**
     * @return mixed
     */
    public function getReacciones()
    {
        return $this->reacciones;
    }

    /**
     * @param mixed $reacciones
     */
    public function setReacciones($reacciones): void
    {
        $this->reacciones = $reacciones;
    }

    /**
     * @return mixed
     */
    public function getComentarios()
    {
        return $this->comentarios;
    }

    /**
     * @param mixed $comentarios
     */
    public function setComentarios($comentarios): void
    {
        $this->comentarios = $comentarios;
    }

    /**
     * @return bool
     */
    public function isEstadoAprobado(): bool
    {
        return $this->estadoAprobado;
    }

    /**
     * @param bool $estadoAprobado
     */
    public function setEstadoAprobado(bool $estadoAprobado): void
    {
        $this->estadoAprobado = $estadoAprobado;
    }

    /**
     * @return bool
     */
    public function isPermiteComentarios(): bool
    {
        return $this->permiteComentarios;
    }

    /**
     * @param bool $permiteComentarios
     */
    public function setPermiteComentarios(bool $permiteComentarios): void
    {
        $this->permiteComentarios = $permiteComentarios;
    }

    /**
     * @return mixed
     */
    public function getUsuarioId()
    {
        return $this->usuarioId;
    }

    /**
     * @param mixed $usuarioId
     */
    public function setUsuarioId($usuarioId): void
    {
        $this->usuarioId = $usuarioId;
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
     * @return mixed
     */
    public function getUsuario()
    {
        return $this->usuario;
    }

    /**
     * @param mixed $usuario
     */
    public function setUsuario($usuario): void
    {
        $this->usuario = $usuario;
    }


}

