<?php

namespace App\Repository;

use App\Entity\Carroceria;
use App\Entity\Combustible;
use App\Entity\Configuracion;
use App\Entity\Linea;
use App\Entity\Marca;
use App\Entity\Usuario;
use App\Entity\Vehiculo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class VehiculoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Vehiculo::class);
    }

    public function lista($usuarioId)
    {
        $em = $this->getEntityManager();
        $queryBuilder = $em->createQueryBuilder()->from(Vehiculo::class, 'v')
            ->select('v.id')
            ->addSelect('v.placa')
            ->addSelect('v.modelo')
            ->where("v.usuarioId = {$usuarioId}");
        $arVehiculos = $queryBuilder->getQuery()->getResult();
        return [
            'error' => false,
            'respuesta' => [
                'vehiculos' => $arVehiculos
            ]
        ];
    }

    public function nuevo($raw)
    {
        $em = $this->getEntityManager();
        $id = $raw['id'] ?? null;
        $usuarioId = $raw['usuarioId'] ?? null;
        $placa = $raw['placa'] ?? null;
        $modelo = $raw['modelo'] ?? null;
        $marcaId = $raw['marcaId'] ?? null;
        $lineaId = $raw['lineaId'] ?? null;
        $carroceriaId = $raw['carroceriaId'] ?? null;
        $combustibleId = $raw['combustibleId'] ?? null;
        $configuracionId = $raw['configuracionId'] ?? null;
        $numeroPoliza = $raw['numeroPoliza'] ?? null;
        $vigenciaPoliza = $raw['vigenciaPoliza'] ?? null;
        $vigenciaRevisionTecnica = $raw['vigenciaRevisionTecnica'] ?? null;
        $numeroEjes = $raw['numeroEjes'] ?? 0;
        $arUsuario = $em->getRepository(Usuario::class)->find($usuarioId);
        if($arUsuario) {
            $arMarca = $em->getRepository(Marca::class)->find($marcaId);
            if($arMarca) {
                $arLinea = $em->getRepository(Linea::class)->find($lineaId);
                if($arLinea) {
                    $arCarroceria = $em->getRepository(Carroceria::class)->find($carroceriaId);
                    if($arCarroceria) {
                        $arCombustible = $em->getRepository(Combustible::class)->find($combustibleId);
                        if($arCombustible) {
                            $arConfiguracion = $em->getRepository(Configuracion::class)->find($configuracionId);
                            if($arConfiguracion) {
                                if($id) {
                                    $arVehiculo = $em->getRepository(Vehiculo::class)->find($id);
                                } else {
                                    $arVehiculo = new Vehiculo();
                                }
                                $arVehiculo->setUsuario($arUsuario);
                                $arVehiculo->setPlaca($placa);
                                $arVehiculo->setModelo($modelo);
                                $arVehiculo->setMarca($arMarca);
                                $arVehiculo->setLinea($arLinea);
                                $arVehiculo->setCarroceria($arCarroceria);
                                $arVehiculo->setCombustible($arCombustible);
                                $arVehiculo->setConfiguracion($arConfiguracion);
                                $arVehiculo->setNumeroPoliza($numeroPoliza);
                                $arVehiculo->setVigenciaPoliza(date_create($vigenciaPoliza));
                                $arVehiculo->setVigenciaRevisionTecnica(date_create($vigenciaRevisionTecnica));
                                $arVehiculo->setNumeroEjes($numeroEjes);
                                $em->persist($arVehiculo);
                                $em->flush();
                                return [
                                    'error' => false,
                                    'respuesta' => [
                                        'id' => $arVehiculo->getId(),
                                    ]
                                ];
                            } else {
                                return [
                                    'error' => true,
                                    'errorMensaje' => "No existe la configuracion"
                                ];
                            }
                        } else {
                            return [
                                'error' => true,
                                'errorMensaje' => "No existe el combustible"
                            ];
                        }
                    } else {
                        return [
                            'error' => true,
                            'errorMensaje' => "No existe la carroceria"
                        ];
                    }
                } else {
                    return [
                        'error' => true,
                        'errorMensaje' => "No existe la linea"
                    ];
                }
            } else {
                return [
                    'error' => true,
                    'errorMensaje' => "No existe la marca"
                ];
            }
        } else {
            return [
                'error' => true,
                'errorMensaje' => "No existe el usuario"
            ];
        }


    }

    public function detalle($codigoVehiculo)
    {
        $em = $this->getEntityManager();
        $queryBuilder = $em->createQueryBuilder()->from(Vehiculo::class, 'v')
            ->select('v.id')
            ->addSelect('v.modelo')
            ->addSelect('v.placa')
            ->where("v.id = {$codigoVehiculo}");
        $arVehiculo = $queryBuilder->getQuery()->getResult();
        return [
            'error' => false,
            'respuesta' => [
                'vehiculo' => $arVehiculo
            ]
        ];
    }

    public function buscar()
    {
        $em = $this->getEntityManager();
        $queryBuilder = $em->createQueryBuilder()->from(Vehiculo::class, 'v')
            ->select('v.id')
            ->addSelect('v.placa')
            ->setMaxResults(10);
        $arVehiculos = $queryBuilder->getQuery()->getResult();
        return [
            'error' => false,
            'respuesta' => [
                'vehiculos' => $arVehiculos
            ]
        ];
    }

}
