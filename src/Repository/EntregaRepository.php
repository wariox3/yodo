<?php

namespace App\Repository;

use App\Entity\Celda;
use App\Entity\CeldaUsuario;
use App\Entity\Entrega;
use App\Entity\EntregaTipo;
use App\Entity\Panal;
use App\Entity\Usuario;
use App\Utilidades\SpaceDO;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class EntregaRepository extends ServiceEntityRepository
{

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Entrega::class);
    }

    public function lista($codigoCelda) {
        $em = $this->getEntityManager();
        $queryBuilder = $em->createQueryBuilder()->from(Entrega::class, 'e')
            ->select('e.id')
            ->addSelect('e.fechaIngreso')
            ->addSelect('e.descripcion')
            ->addSelect('e.entregaTipoId')
            ->addSelect('e.estadoEntregado')
            ->addSelect("CONCAT('{$_ENV['ALMACENAMIENTO_URL']}', e.urlImagenIngreso) as urlImagenIngreso")
            ->addSelect('et.nombre as entregaTipoNombre')
            ->leftJoin('e.entregaTipo', 'et')
            ->where("e.celdaId = {$codigoCelda}")
            ->setMaxResults(20);
        $arEntregas = $queryBuilder->getQuery()->getResult();
        $respuesta = [
            'error' => false,
            'respuesta' => [
                'entregas' => $arEntregas
            ]
        ];
        return $respuesta;
    }

    public function nuevo($raw)
    {
        $em = $this->getEntityManager();
        $codigoPanal = $raw['codigoPanal']?? null;
        $celda = $raw['celda']?? null;
        $codigoEntregaTipo = $raw['codigoEntregaTipo']?? null;
        $imagen = $raw['imagenBase64']?? null;
        $arPanal = $em->getRepository(Panal::class)->find($codigoPanal);
        if($arPanal) {
            $arCelda = $em->getRepository(Celda::class)->findOneBy(['panalId' => $codigoPanal, 'celda' => $celda]);
            if($arCelda) {
                $arEntrega = new Entrega();
                $arEntrega->setCelda($arCelda);
                $arEntrega->setFechaIngreso(new \DateTime('now'));
                $arEntrega->setEntregaTipo($em->getReference(EntregaTipo::class, $codigoEntregaTipo));
                if($imagen) {
                    $spaceDO = new SpaceDO();
                    $respuesta = $spaceDO->subirB64('entrega', $imagen);
                    $arEntrega->setUrlImagenIngreso($respuesta['url']);
                }
                $em->persist($arEntrega);
                $em->flush();

                //Usuarios a los que se debe notificar
                /*$arCeldaUsuarios = $em->getRepository(CeldaUsuario::class)->findBy(['codigoCeldaFk' => $arCelda->getCodigoCeldaPk()]);
                foreach ($arCeldaUsuarios as $arCeldaUsuario) {
                    $this->firebase->nuevaEntrega($arCeldaUsuario->getUsuarioRel()->getTokenFirebase(), $arEntrega->getCodigoEntregaPk(), $tipo, 0);
                }*/

                return [
                    'error' => false,
                    'respuesta' => [
                        'entrega' =>   $arEntrega->getId()
                    ]
                ];
            } else {
                return [
                    'error' => true,
                    'errorMensaje' => "No existe la celda"
                ];
            }
        } else {
            return [
                'error' => true,
                'errorMensaje' => "No existe el panal"
            ];
        }
    }

    public function detalle($codigoEntrega)
    {
        $em = $this->getEntityManager();
        $queryBuilder = $em->createQueryBuilder()->from(Entrega::class, 'e')
            ->select('e.id')
            ->addSelect('e.fechaIngreso')
            ->addSelect('e.entregaTipoId')
            ->addSelect('e.descripcion')
            ->addSelect("CONCAT('{$_ENV['ALMACENAMIENTO_URL']}', e.urlImagenIngreso) as urlImagenIngreso")
            ->addSelect('c.celda')
            ->addSelect('et.nombre as entregaTipoNombre')
            ->leftJoin('e.celda', 'c')
            ->leftJoin('e.entregaTipo', 'et')
            ->where("e.id = {$codigoEntrega}");
        $arEntrega = $queryBuilder->getQuery()->getOneOrNullResult();
        return [
            'error' => false,
            'respuesta' => [
                'entrega' => $arEntrega
            ]
        ];
    }

    public function pendiente($codigoPanal, $celda)
    {
        $em = $this->getEntityManager();
        $queryBuilder = $em->createQueryBuilder()->from(Entrega::class, 'e')
            ->select('e.id')
            ->addSelect('e.fechaIngreso')
            ->addSelect('e.entregaTipoId')
            ->addSelect('e.descripcion')
            ->addSelect('c.celda')
            ->addSelect('et.nombre as entregaTipoNombre')
            ->leftJoin('e.celda', 'c')
            ->leftJoin('e.entregaTipo', 'et')
            ->where("c.panalId = {$codigoPanal}")
            ->andWhere("e.estadoEntregado = false")
            ->addOrderBy("e.fechaIngreso", "DESC");
        if($celda) {
            $queryBuilder->andWhere("c.celda = '{$celda}'");
        }
        $arEntregas = $queryBuilder->getQuery()->getResult();
        return [
            'error' => false,
            'respuesta' => [
                'entregas' => $arEntregas
            ]
        ];
    }

    public function entrega($raw)
    {
        $em = $this->getEntityManager();
        $codigoEntrega = $raw['codigoEntrega']?? null;
        $codigoUsuario = $raw['codigoUsuario']?? null;
        $arrImagen = $raw['imagenBase64']??[];
        $arEntrega = $em->getRepository(Entrega::class)->find($codigoEntrega);
        if($arEntrega) {
            if($arEntrega->isEstadoEntregado() == false) {
                $arUsuario = $em->getRepository(Usuario::class)->find($codigoUsuario);
                if($arUsuario) {
                    $arEntrega->setEstadoEntregado(true);
                    $arEntrega->setFechaEntrega(new \DateTime('now'));
                    if($arrImagen) {
                        //$archivo = $this->space->subir('entrega', $imagen);
                        //$arEntrega->setUrlImagen($archivo['url']);
                    }
                    $em->persist($arEntrega);
                    $em->flush();
                    return [
                        'error' => false,
                        'respuesta' => [
                            'mensaje' => 'La entrega fue entregada con exito'
                        ]
                    ];
                } else {
                    return [
                        'error' => true,
                        'errorMensaje' => "No existe el usuario"
                    ];
                }
            } else {
                return [
                    'error' => true,
                    'errorMensaje' => "La entrega ya fue entregada al cliente"
                ];
            }
        } else {
            return [
                'error' => true,
                'errorMensaje' => "No existe la entrega"
            ];
        }
    }

}