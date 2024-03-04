<?php

namespace App\Repository;

use App\Entity\Despacho;
use App\Entity\Guia;
use App\Entity\Operador;
use App\Entity\Usuario;
use App\Utilidades\Semantica;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class DespachoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Despacho::class);
    }

    public function nuevo($codigoUsuario, $operador, $codigoDespacho, $token)
    {
        $em = $this->getEntityManager();
        $arUsuario = $em->getRepository(Usuario::class)->find($codigoUsuario);
        if($arUsuario) {
            $arOperador = $em->getRepository(Operador::class)->find($operador);
            if($arOperador) {
                $arDespacho = $em->getRepository(Despacho::class)->findOneBy(['operadorId' => $operador, 'codigo' => $codigoDespacho]);
                if($arDespacho) {
                    if($arDespacho->getUsuario()) {
                        if($arDespacho->getUsuarioId() == $codigoUsuario) {
                            return [
                                'error' => true,
                                'errorMensaje' => "El despacho ya fue cargado con anterioridad"
                            ];
                        } else {
                            return [
                                'error' => true,
                                'errorMensaje' => "El despacho ya fue cargado por otro usuario"
                            ];
                        }
                    } else {
                        $arDespacho->setUsuario($arUsuario);
                        $em->persist($arDespacho);
                        $em->flush();
                        return [
                            'error' => false,
                            'respuesta' => [
                                'id' => $arDespacho->getId(),
                            ]
                        ];
                    }
                } else {
                    $parametros = [
                        "codigoDespacho" => $codigoDespacho,
                    ];
                    $semantica = new Semantica();
                    $respuesta = $semantica->post($arOperador, '/api/transporte/despacho/cargar/v2', $parametros);
                    if($respuesta['error'] == false) {
                        $despacho = $respuesta['despacho'];
                        $guias = $respuesta['guias'];
                        $arDespacho = new Despacho();
                        $arDespacho->setCodigo($codigoDespacho);
                        $arDespacho->setFechaCreacion(new \DateTime('now'));
                        $arDespacho->setFechaSalida(date_create($despacho['fechaSalida']));
                        $arDespacho->setNumero($despacho['numero']);
                        $arDespacho->setUsuario($arUsuario);
                        $arDespacho->setOperador($arOperador);
                        $arDespacho->setToken($despacho['apiToken']);
                        $em->persist($arDespacho);
                        foreach ($guias as $guia) {
                            $arGuia = new Guia();
                            $arGuia->setDespacho($arDespacho);
                            $arGuia->setCodigo($guia['codigoGuiaFk']);
                            $arGuia->setFecha(date_create($guia['fechaIngreso']));
                            $arGuia->setDocumentoCliente($guia['documentoCliente']);
                            $arGuia->setUnidades($guia['unidades']);
                            $arGuia->setPesoReal($guia['pesoReal']);
                            $arGuia->setPesoVolumen($guia['pesoVolumen']);
                            $arGuia->setVrCobroEntrega($guia['vrCobroEntrega']);
                            $arGuia->setRemitente($guia['nombreRemitente']);
                            $arGuia->setDestinatario($guia['destinatario']);
                            $arGuia->setDestinatarioTelefono($guia['telefonoDestinatario']);
                            $arGuia->setDestinatarioDireccion($guia['direccionDestinatario']);
                            $arGuia->setCiudadDestinoNombre($guia['destino']);
                            $arGuia->setDepartamentoDestinoNombre($guia['departamentoDestinoNombre']);
                            $arGuia->setEntregaRequiereFoto($guia['terceroEntregaRequiereFoto']);
                            $arGuia->setEntregaRequiereFirma($guia['terceroEntregaRequiereFirma']);
                            $arGuia->setEntregaRequiereDatos($guia['terceroEntregaRequiereDatos']);
                            $em->persist($arGuia);
                        }
                        $em->flush();
                        return [
                            'error' => false,
                            'respuesta' => [
                                'id' => $arDespacho->getId(),
                            ]
                        ];
                    } else {
                        return [
                            'error' => true,
                            'errorMensaje' => $respuesta['errorMensaje']
                        ];
                    }
                }
            } else {
                return [
                    'error' => true,
                    'errorMensaje' => "No existe el operador"
                ];
            }
        } else {
            return [
                'error' => true,
                'errorMensaje' => "No existe el usuario"
            ];
        }
    }

    public function lista($codigoUsuario)
    {
        $em = $this->getEntityManager();
        $queryBuilder = $em->createQueryBuilder()->from(Despacho::class, 'd')
            ->select('d.id')
            ->addSelect('d.numero')
            ->addSelect('d.fechaCreacion')
            ->addSelect('d.fechaSalida')
            ->addSelect('d.operadorId')
            ->addSelect('d.codigo')
            ->addSelect('d.token')
            ->addSelect('o.nombre as operadorNombre')
            ->leftJoin('d.operador', 'o')
            ->andWhere("d.usuarioId = {$codigoUsuario}")
            ->orderBy('d.fechaCreacion', 'DESC')
            ->setMaxResults(20);
        $arDespachos = $queryBuilder->getQuery()->getResult();
        return [
            'error' => false,
            'respuesta' => [
                'despachos' => $arDespachos,
            ]
        ];
    }

    public function detalle($despachoId)
    {
        $em = $this->getEntityManager();
        $arDespacho = $em->getRepository(Despacho::class)->find($despachoId);
        if($arDespacho) {
            $queryBuilder = $em->createQueryBuilder()->from(Guia::class, 'g')
                ->select('g.id')
                ->addSelect('g.codigo')
                ->addSelect('g.fecha')
                ->addSelect('g.documentoCliente')
                ->addSelect('g.unidades')
                ->addSelect('g.pesoReal')
                ->addSelect('g.estadoNovedad')
                ->addSelect('g.remitente')
                ->addSelect('g.destinatario')
                ->addSelect('g.destinatarioTelefono')
                ->addSelect('g.destinatarioDireccion')
                ->addSelect('g.vrCobroEntrega')
                ->addSelect('g.ciudadDestinoNombre')
                ->addSelect('g.departamentoDestinoNombre')
                ->addSelect('g.entregaRequiereDatos')
                ->addSelect('g.entregaRequiereFirma')
                ->addSelect('g.entregaRequiereFoto')
                ->where("g.despachoId = " . $despachoId)
                ->andWhere('g.estadoEntrega = false')
                ->orderBy('g.ciudadDestinoNombre');
            $arGuias = $queryBuilder->getQuery()->getResult();
            return [
                'error' => false,
                'respuesta' => [
                    'despacho' => [
                        'id' => $arDespacho->getId(),
                        'codigo' => $arDespacho->getCodigo()
                    ],
                    'guias' => $arGuias
                ]
            ];
        } else {
            return [
                'error' => true,
                'errorMensaje' => "El despacho no existe"
            ];
        }
    }
}
