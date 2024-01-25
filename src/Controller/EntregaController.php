<?php

namespace App\Controller;

use App\Entity\Celda;
use App\Entity\Ciudad;
use App\Entity\Entrega;
use App\Entity\Panal;
use App\Entity\Usuario;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class EntregaController extends AbstractFOSRestController
{
    #[Route('/api/entrega/lista', name: 'api_entrega_lista')]
    public function lista(Request $request, EntityManagerInterface $em) {
        $raw = json_decode($request->getContent(), true);
        $codigoCelda = $raw['codigoCelda']?? null;
        if($codigoCelda) {
            $arrRespuesta = $em->getRepository(Entrega::class)->lista($codigoCelda);
            if(!$arrRespuesta['error']) {
                return $this->view($arrRespuesta['respuesta'], 200);
            } else {
                return $this->view(['mensaje' => $arrRespuesta['errorMensaje']], 400);
            }
        } else {
            return $this->view(['mensaje' => 'Faltan datos para el consumo de la API'], 400);
        }
    }

    #[Route('/api/entrega/nuevo', name: 'api_entrega_nuevo')]
    public function nuevo(Request $request, EntityManagerInterface $em) {
        $raw = json_decode($request->getContent(), true);
        $codigoPanal = $raw['codigoPanal']?? null;
        $celda = $raw['celda']?? null;
        $codigoEntregaTipo = $raw['codigoEntregaTipo']?? null;
        if($codigoPanal && $celda && $codigoEntregaTipo) {
            $arrRespuesta = $em->getRepository(Entrega::class)->nuevo($raw);
            if(!$arrRespuesta['error']) {
                return $this->view($arrRespuesta['respuesta'], 200);
            } else {
                return $this->view(['mensaje' => $arrRespuesta['errorMensaje']], 400);
            }
        } else {
            return $this->view(['mensaje' => 'Faltan datos para el consumo de la API'], 400);
        }
    }

    #[Route('/api/entrega/detalle', name: 'api_entrega_detalle')]
    public function detalle(Request $request, EntityManagerInterface $em) {
        $raw = json_decode($request->getContent(), true);
        $codigoEntrega = $raw['codigoEntrega']?? null;
        if($codigoEntrega) {
            $arrRespuesta = $em->getRepository(Entrega::class)->detalle($codigoEntrega);
            if(!$arrRespuesta['error']) {
                return $this->view($arrRespuesta['respuesta'], 200);
            } else {
                return $this->view(['mensaje' => $arrRespuesta['errorMensaje']], 400);
            }
        } else {
            return $this->view(['mensaje' => 'Faltan datos para el consumo de la API'], 400);
        }
    }

    #[Route('/api/entrega/pendiente', name: 'api_entrega_pendiente')]
    public function pendiente(Request $request, EntityManagerInterface $em) {
        $raw = json_decode($request->getContent(), true);
        $codigoPanal = $raw['codigoPanal']?? null;
        $celda = $raw['celda']?? null;
        if($codigoPanal) {
            $arrRespuesta = $em->getRepository(Entrega::class)->pendiente($codigoPanal, $celda);
            if(!$arrRespuesta['error']) {
                return $this->view($arrRespuesta['respuesta'], 200);
            } else {
                return $this->view(['mensaje' => $arrRespuesta['errorMensaje']], 400);
            }
        } else {
            return $this->view(['mensaje' => 'Faltan datos para el consumo de la API'], 400);
        }
    }

    #[Route('/api/entrega/entrega', name: 'api_entrega_entrega')]
    public function entrega(Request $request, EntityManagerInterface $em) {
        $raw = json_decode($request->getContent(), true);
        $codigoEntrega = $raw['codigoEntrega']?? null;
        $codigoUsuario = $raw['codigoUsuario']?? null;
        if($codigoEntrega && $codigoUsuario) {
            $arrRespuesta = $em->getRepository(Entrega::class)->entrega($raw);
            if(!$arrRespuesta['error']) {
                return $this->view($arrRespuesta['respuesta'], 200);
            } else {
                return $this->view(['mensaje' => $arrRespuesta['errorMensaje']], 400);
            }
        } else {
            return $this->view(['mensaje' => 'Faltan datos para el consumo de la API'], 400);
        }
    }
}
