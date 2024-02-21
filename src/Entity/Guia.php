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

    #[ORM\Column(type: "integer")]
    private $codigo;

    #[ORM\Column(type: "datetime")]
    private $fecha = null;

    #[ORM\Column(length: 80, nullable: true)]
    private ?string $documentoCliente = null;

    #[ORM\Column(type: "float", options: ["default" => 0])]
    private $unidades = 0.0;

    #[ORM\Column(type: "float", options: ["default" => 0])]
    private $pesoReal = 0.0;

    #[ORM\Column(type: "float", options: ["default" => 0])]
    private $pesoVolumen = 0.0;

    #[ORM\Column(type: "float", options: ["default" => 0])]
    private $vrCobroEntrega = 0.0;

    #[ORM\Column(type: "boolean", options: ["default" => false])]
    private $estadoNovedad = false;

    #[ORM\Column(type: "boolean", options: ["default" => false])]
    private $estadoEntrega = false;

    #[ORM\Column(length: 150, nullable: true)]
    private ?string $remitente = null;

    #[ORM\Column(length: 150, nullable: true)]
    private ?string $destinatario = null;

    #[ORM\Column(length: 80, nullable: true)]
    private ?string $destinatarioTelefono = null;

    #[ORM\Column(length: 150, nullable: true)]
    private ?string $destinatarioDireccion = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $ciudadDestinoNombre = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $departamentoDestinoNombre = null;

    #[ORM\Column(type: "boolean", options: ["default" => false])]
    private $entregaRequiereFoto = false;

    #[ORM\Column(type: "boolean", options: ["default" => false])]
    private $entregaRequiereFirma = false;

    #[ORM\Column(type: "boolean", options: ["default" => false])]
    private $entregaRequiereDatos = false;

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

    /**
     * @return null
     */
    public function getFecha()
    {
        return $this->fecha;
    }

    /**
     * @param null $fecha
     */
    public function setFecha($fecha): void
    {
        $this->fecha = $fecha;
    }

    /**
     * @return string|null
     */
    public function getDocumentoCliente(): ?string
    {
        return $this->documentoCliente;
    }

    /**
     * @param string|null $documentoCliente
     */
    public function setDocumentoCliente(?string $documentoCliente): void
    {
        $this->documentoCliente = $documentoCliente;
    }

    /**
     * @return float
     */
    public function getUnidades(): float
    {
        return $this->unidades;
    }

    /**
     * @param float $unidades
     */
    public function setUnidades(float $unidades): void
    {
        $this->unidades = $unidades;
    }

    /**
     * @return float
     */
    public function getPesoReal(): float
    {
        return $this->pesoReal;
    }

    /**
     * @param float $pesoReal
     */
    public function setPesoReal(float $pesoReal): void
    {
        $this->pesoReal = $pesoReal;
    }

    /**
     * @return float
     */
    public function getPesoVolumen(): float
    {
        return $this->pesoVolumen;
    }

    /**
     * @param float $pesoVolumen
     */
    public function setPesoVolumen(float $pesoVolumen): void
    {
        $this->pesoVolumen = $pesoVolumen;
    }

    /**
     * @return float
     */
    public function getVrCobroEntrega(): float
    {
        return $this->vrCobroEntrega;
    }

    /**
     * @param float $vrCobroEntrega
     */
    public function setVrCobroEntrega(float $vrCobroEntrega): void
    {
        $this->vrCobroEntrega = $vrCobroEntrega;
    }

    /**
     * @return bool
     */
    public function isEstadoNovedad(): bool
    {
        return $this->estadoNovedad;
    }

    /**
     * @param bool $estadoNovedad
     */
    public function setEstadoNovedad(bool $estadoNovedad): void
    {
        $this->estadoNovedad = $estadoNovedad;
    }

    /**
     * @return string|null
     */
    public function getRemitente(): ?string
    {
        return $this->remitente;
    }

    /**
     * @param string|null $remitente
     */
    public function setRemitente(?string $remitente): void
    {
        $this->remitente = $remitente;
    }

    /**
     * @return string|null
     */
    public function getDestinatario(): ?string
    {
        return $this->destinatario;
    }

    /**
     * @param string|null $destinatario
     */
    public function setDestinatario(?string $destinatario): void
    {
        $this->destinatario = $destinatario;
    }

    /**
     * @return string|null
     */
    public function getDestinatarioTelefono(): ?string
    {
        return $this->destinatarioTelefono;
    }

    /**
     * @param string|null $destinatarioTelefono
     */
    public function setDestinatarioTelefono(?string $destinatarioTelefono): void
    {
        $this->destinatarioTelefono = $destinatarioTelefono;
    }

    /**
     * @return string|null
     */
    public function getDestinatarioDireccion(): ?string
    {
        return $this->destinatarioDireccion;
    }

    /**
     * @param string|null $destinatarioDireccion
     */
    public function setDestinatarioDireccion(?string $destinatarioDireccion): void
    {
        $this->destinatarioDireccion = $destinatarioDireccion;
    }

    /**
     * @return string|null
     */
    public function getCiudadDestinoNombre(): ?string
    {
        return $this->ciudadDestinoNombre;
    }

    /**
     * @param string|null $ciudadDestinoNombre
     */
    public function setCiudadDestinoNombre(?string $ciudadDestinoNombre): void
    {
        $this->ciudadDestinoNombre = $ciudadDestinoNombre;
    }

    /**
     * @return string|null
     */
    public function getDepartamentoDestinoNombre(): ?string
    {
        return $this->departamentoDestinoNombre;
    }

    /**
     * @param string|null $departamentoDestinoNombre
     */
    public function setDepartamentoDestinoNombre(?string $departamentoDestinoNombre): void
    {
        $this->departamentoDestinoNombre = $departamentoDestinoNombre;
    }

    /**
     * @return bool
     */
    public function isEntregaRequiereFoto(): bool
    {
        return $this->entregaRequiereFoto;
    }

    /**
     * @param bool $entregaRequiereFoto
     */
    public function setEntregaRequiereFoto(bool $entregaRequiereFoto): void
    {
        $this->entregaRequiereFoto = $entregaRequiereFoto;
    }

    /**
     * @return bool
     */
    public function isEntregaRequiereFirma(): bool
    {
        return $this->entregaRequiereFirma;
    }

    /**
     * @param bool $entregaRequiereFirma
     */
    public function setEntregaRequiereFirma(bool $entregaRequiereFirma): void
    {
        $this->entregaRequiereFirma = $entregaRequiereFirma;
    }

    /**
     * @return bool
     */
    public function isEntregaRequiereDatos(): bool
    {
        return $this->entregaRequiereDatos;
    }

    /**
     * @param bool $entregaRequiereDatos
     */
    public function setEntregaRequiereDatos(bool $entregaRequiereDatos): void
    {
        $this->entregaRequiereDatos = $entregaRequiereDatos;
    }

    /**
     * @return bool
     */
    public function isEstadoEntrega(): bool
    {
        return $this->estadoEntrega;
    }

    /**
     * @param bool $estadoEntrega
     */
    public function setEstadoEntrega(bool $estadoEntrega): void
    {
        $this->estadoEntrega = $estadoEntrega;
    }


}
