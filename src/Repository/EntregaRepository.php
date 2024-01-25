<?php

namespace App\Repository;

use App\Entity\Celda;
use App\Entity\CeldaUsuario;
use App\Entity\Entrega;
use App\Entity\EntregaTipo;
use App\Entity\Panal;
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
                    //$archivo = $this->space->subir('entrega', $imagen);
                    //$arEntrega->setUrlImagenIngreso($archivo['url']);
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
}