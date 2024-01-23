<?php

namespace App\Entity;

use App\Repository\UsuarioRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UsuarioRepository::class)]
class Usuario implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $username = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $email = null;

    #[ORM\Column]
    private array $roles = [];

    #[ORM\Column(length: 180, nullable: true)]
    private ?string $nombreCorto = null;

    #[ORM\Column(length: 20, nullable: true)]
    private ?string $celular = null;

    #[ORM\Column(length: 250, nullable: true)]
    private ?string $imagenPerfil = null;

    #[ORM\Column(length: 500, nullable: true)]
    private ?string $tokenFirebase = null;

    #[ORM\Column(type: "integer", nullable: true)]
    private $panalId;

    #[ORM\Column(type: "integer", nullable: true)]
    private $celdaId;

    #[ORM\Column(type: "integer", nullable: true)]
    private $ciudadId;

    #[ORM\ManyToOne(targetEntity: Celda::class, inversedBy: 'usuarios')]
    #[ORM\JoinColumn(name: "celda_id", referencedColumnName: "id")]
    private $celda;

    #[ORM\ManyToOne(targetEntity: Panal::class, inversedBy: 'usuarios')]
    #[ORM\JoinColumn(name: "panal_id", referencedColumnName: "id")]
    private $panal;

    #[ORM\ManyToOne(targetEntity: Ciudad::class, inversedBy: 'usuarios')]
    #[ORM\JoinColumn(name: "ciudad_id", referencedColumnName: "id")]
    private $ciudad;

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getNombreCorto(): ?string
    {
        return $this->nombreCorto;
    }

    public function setNombreCorto(?string $nombreCorto): void
    {
        $this->nombreCorto = $nombreCorto;
    }

    public function getCelular(): ?string
    {
        return $this->celular;
    }

    public function setCelular(?string $celular): void
    {
        $this->celular = $celular;
    }

    public function getImagenPerfil(): ?string
    {
        return $this->imagenPerfil;
    }

    public function setImagenPerfil(?string $imagenPerfil): void
    {
        $this->imagenPerfil = $imagenPerfil;
    }

    public function getTokenFirebase(): ?string
    {
        return $this->tokenFirebase;
    }

    public function setTokenFirebase(?string $tokenFirebase): void
    {
        $this->tokenFirebase = $tokenFirebase;
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
    public function getCiudadId()
    {
        return $this->ciudadId;
    }

    /**
     * @param mixed $ciudadId
     */
    public function setCiudadId($ciudadId): void
    {
        $this->ciudadId = $ciudadId;
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
    public function getCiudad()
    {
        return $this->ciudad;
    }

    /**
     * @param mixed $ciudad
     */
    public function setCiudad($ciudad): void
    {
        $this->ciudad = $ciudad;
    }



}
