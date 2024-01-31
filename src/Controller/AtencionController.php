<?php

namespace App\Controller;

use App\Entity\Atencion;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AtencionController extends AbstractFOSRestController
{
    #[Route('/api/atencion/lista', name: 'api_atencion_lista')]
    public function lista(Request $request, EntityManagerInterface $em)
    {
        $raw = json_decode($request->getContent(), true);
        $codigoPanal = $raw['codigoPanal']?? null;
        $codigoUsuario = $raw['codigoUsuario']?? null;
        if($codigoPanal && $codigoUsuario) {
            $arrRespuesta = $em->getRepository(Atencion::class)->apiLista($codigoPanal, $codigoUsuario);
            if(!$arrRespuesta['error']) {
                return $this->view($arrRespuesta['respuesta'], 200);
            } else {
                return $this->view(['mensaje' => $arrRespuesta['errorMensaje']], 400);
            }
        } else {
            return $this->view(['mensaje' => 'Faltan datos para el consumo de la API'], 400);
        }
    }

    #[Route('/api/atencion/nuevo', name: 'api_atencion_nuevo')]
    public function nuevo(Request $request, EntityManagerInterface $em)
    {
        $raw = json_decode($request->getContent(), true);
        $codigoUsuario = $raw['codigoUsuario'] ?? null;
        $codigoCelda = $raw['codigoCelda'] ?? null;
        $descripcion = $raw['descripcion'] ?? null;
        if($codigoUsuario && $codigoCelda) {
            $arrRespuesta = $em->getRepository(Atencion::class)->apiNuevo($codigoUsuario, $codigoCelda, $descripcion);
            if(!$arrRespuesta['error']) {
                return $this->view($arrRespuesta['respuesta'], 200);
            } else {
                return $this->view(['mensaje' => $arrRespuesta['errorMensaje']], 400);
            }
        } else {
            return $this->view(['mensaje' => 'Faltan datos para el consumo de la API'], 400);
        }
    }

    #[Route('/api/atencion/pendiente', name: 'api_atencion_pendiente')]
    public function pendiente(Request $request, EntityManagerInterface $em)
    {
        $raw = json_decode($request->getContent(), true);
        $codigoPanal = $raw['codigoPanal']?? null;
        $celda = $raw['celda']?? null;
        if($codigoPanal) {
            $arrRespuesta = $em->getRepository(Atencion::class)->apiPendiente($codigoPanal, $celda);
            if(!$arrRespuesta['error']) {
                return $this->view($arrRespuesta['respuesta'], 200);
            } else {
                return $this->view(['mensaje' => $arrRespuesta['errorMensaje']], 400);
            }
        } else {
            return $this->view(['mensaje' => 'Faltan datos para el consumo de la API'], 400);
        }
    }


    #[Route('/api/atencion/atendido', name: 'api_atencion_atendido')]
    public function atendido(Request $request, EntityManagerInterface $em)
    {
        $raw = json_decode($request->getContent(), true);
        $codigoAtencion = $raw['codigoAtencion']?? null;
        if($codigoAtencion) {
            $arrRespuesta = $em->getRepository(Atencion::class)->apiAtendido($codigoAtencion);
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