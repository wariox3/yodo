<?php


namespace App\Entity;

use App\Repository\CeldaUsuarioRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CeldaUsuarioRepository::class)]
class CeldaUsuario
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: "integer")]
    private $celdaId;

    #[ORM\Column(type: "integer")]
    private $usuarioId;

    #[ORM\Column(length: 200)]
    private ?string $llave;

    #[ORM\Column(type: "boolean", options: ["default" => false])]
    private $validado = false;

    #[ORM\ManyToOne(targetEntity: Celda::class, inversedBy: 'celdasUsuarios')]
    #[ORM\JoinColumn(name: "celda_id", referencedColumnName: "id")]
    private $celda;

    #[ORM\ManyToOne(targetEntity: Usuario::class, inversedBy: 'celdasUsuarios')]
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

    /**
     * @return bool
     */
    public function isValidado(): bool
    {
        return $this->validado;
    }

    /**
     * @param bool $validado
     */
    public function setValidado(bool $validado): void
    {
        $this->validado = $validado;
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

