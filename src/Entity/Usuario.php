<?php

namespace App\Entity;

use App\Repository\UsuarioRepository;
use Doctrine\Common\Collections\Collection;
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

    #[ORM\Column(type: "float", options: ["default" => 0])]
    private $saldo = 0.0;

    #[ORM\ManyToOne(targetEntity: Celda::class, inversedBy: 'usuarios')]
    #[ORM\JoinColumn(name: "celda_id", referencedColumnName: "id")]
    private $celda;

    #[ORM\ManyToOne(targetEntity: Panal::class, inversedBy: 'usuarios')]
    #[ORM\JoinColumn(name: "panal_id", referencedColumnName: "id")]
    private $panal;

    #[ORM\ManyToOne(targetEntity: Ciudad::class, inversedBy: 'usuarios')]
    #[ORM\JoinColumn(name: "ciudad_id", referencedColumnName: "id")]
    private $ciudad;

    #[ORM\OneToMany(targetEntity: CeldaUsuario::class, mappedBy: 'usuario')]
    private Collection $celdasUsuarios;

    #[ORM\OneToMany(targetEntity: Publicacion::class, mappedBy: 'usuario')]
    private Collection $publicaciones;

    #[ORM\OneToMany(targetEntity: Visita::class, mappedBy: 'usuarioAutoriza')]
    private Collection $visitas;

    #[ORM\OneToMany(targetEntity: Caso::class, mappedBy: 'usuario')]
    private Collection $casos;

    #[ORM\OneToMany(targetEntity: Atencion::class, mappedBy: 'usuario')]
    private Collection $atenciones;

    #[ORM\OneToMany(targetEntity: Soporte::class, mappedBy: 'usuario')]
    private Collection $soportes;

    #[ORM\OneToMany(targetEntity: Solicitud::class, mappedBy: 'usuario')]
    private Collection $solcitudes;

    #[ORM\OneToMany(targetEntity: Solicitud::class, mappedBy: 'usuarioAsignado')]
    private Collection $solcitudesUsuarioAsignado;

    #[ORM\OneToMany(targetEntity: SolicitudAplicacion::class, mappedBy: 'usuario')]
    private Collection $solicitudesAplicaciones;

    #[ORM\OneToMany(targetEntity: Despacho::class, mappedBy: 'usuario')]
    private Collection $despachos;

    #[ORM\OneToMany(targetEntity: Vehiculo::class, mappedBy: 'usuario')]
    private Collection $vehiculos;

    #[ORM\OneToMany(targetEntity: CambioClave::class, mappedBy: 'usuario')]
    private Collection $cambiosClave;

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
     * @return float
     */
    public function getSaldo(): float
    {
        return $this->saldo;
    }

    /**
     * @param float $saldo
     */
    public function setSaldo(float $saldo): void
    {
        $this->saldo = $saldo;
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
     * @return Collection
     */
    public function getPublicaciones(): Collection
    {
        return $this->publicaciones;
    }

    /**
     * @param Collection $publicaciones
     */
    public function setPublicaciones(Collection $publicaciones): void
    {
        $this->publicaciones = $publicaciones;
    }

    /**
     * @return Collection
     */
    public function getVisitas(): Collection
    {
        return $this->visitas;
    }

    /**
     * @param Collection $visitas
     */
    public function setVisitas(Collection $visitas): void
    {
        $this->visitas = $visitas;
    }

    /**
     * @return Collection
     */
    public function getCasos(): Collection
    {
        return $this->casos;
    }

    /**
     * @param Collection $casos
     */
    public function setCasos(Collection $casos): void
    {
        $this->casos = $casos;
    }

    /**
     * @return Collection
     */
    public function getAtenciones(): Collection
    {
        return $this->atenciones;
    }

    /**
     * @param Collection $atenciones
     */
    public function setAtenciones(Collection $atenciones): void
    {
        $this->atenciones = $atenciones;
    }

    /**
     * @return Collection
     */
    public function getSoportes(): Collection
    {
        return $this->soportes;
    }

    /**
     * @param Collection $soportes
     */
    public function setSoportes(Collection $soportes): void
    {
        $this->soportes = $soportes;
    }

    /**
     * @return Collection
     */
    public function getSolcitudes(): Collection
    {
        return $this->solcitudes;
    }

    /**
     * @param Collection $solcitudes
     */
    public function setSolcitudes(Collection $solcitudes): void
    {
        $this->solcitudes = $solcitudes;
    }

    /**
     * @return Collection
     */
    public function getSolcitudesUsuarioAsignado(): Collection
    {
        return $this->solcitudesUsuarioAsignado;
    }

    /**
     * @param Collection $solcitudesUsuarioAsignado
     */
    public function setSolcitudesUsuarioAsignado(Collection $solcitudesUsuarioAsignado): void
    {
        $this->solcitudesUsuarioAsignado = $solcitudesUsuarioAsignado;
    }

    /**
     * @return Collection
     */
    public function getSolicitudesAplicaciones(): Collection
    {
        return $this->solicitudesAplicaciones;
    }

    /**
     * @param Collection $solicitudesAplicaciones
     */
    public function setSolicitudesAplicaciones(Collection $solicitudesAplicaciones): void
    {
        $this->solicitudesAplicaciones = $solicitudesAplicaciones;
    }

    /**
     * @return Collection
     */
    public function getDespachos(): Collection
    {
        return $this->despachos;
    }

    /**
     * @param Collection $despachos
     */
    public function setDespachos(Collection $despachos): void
    {
        $this->despachos = $despachos;
    }

    public function getVehiculos(): Collection
    {
        return $this->vehiculos;
    }

    public function setVehiculos(Collection $vehiculos): void
    {
        $this->vehiculos = $vehiculos;
    }

    public function getCambiosClave(): Collection
    {
        return $this->cambiosClave;
    }

    public function setCambiosClave(Collection $cambiosClave): void
    {
        $this->cambiosClave = $cambiosClave;
    }


}
