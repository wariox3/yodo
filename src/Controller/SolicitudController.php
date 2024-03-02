<?php

namespace App\Controller;

use App\Entity\Solicitud;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class SolicitudController extends AbstractFOSRestController
{
    #[Route('/api/solicitud/nuevo', methods: ['POST', 'PUT'])]
    public function nuevo(Request $request, EntityManagerInterface $em)
    {
        $raw = json_decode($request->getContent(), true);
        $metodo = $request->getMethod();
        $id = $raw['id'] ?? null;
        $usuarioId = $raw['usuarioId']?? null;
        $ciudadOrigenId = $raw['ciudadOrigenId']?? null;
        $ciudadDestinoId = $raw['ciudadDestinoId']?? null;
        $carroceriaId = $raw['carroceriaId']?? null;
        if($metodo == 'PUT' && $id == null) {
            return $this->view(['mensaje' => 'Para el metodo PUT debe enviarse el id'], 400);
        } else {
            if($usuarioId && $ciudadOrigenId && $ciudadDestinoId && $carroceriaId) {
                $arrRespuesta = $em->getRepository(Solicitud::class)->nuevo($raw);
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

    #[Route('/api/solicitud/pendiente')]
    public function pendiente(EntityManagerInterface $em) {
        $arrRespuesta = $em->getRepository(Solicitud::class)->pendiente();
        if(!$arrRespuesta['error']) {
            return $this->view($arrRespuesta['respuesta'], 200);
        } else {
            return $this->view(['mensaje' => $arrRespuesta['errorMensaje']], 400);
        }
    }

    #[Route('/api/solicitud/aplicar')]
    public function aplicar(Request $request, EntityManagerInterface $em) {
        $raw = json_decode($request->getContent(), true);
        $codigoUsuario = $raw['codigoUsuario']?? null;
        $codigoSolicitud = $raw['codigoSolicitud']?? null;
        if($codigoUsuario && $codigoSolicitud) {
            $arrRespuesta = $em->getRepository(Solicitud::class)->aplicar($codigoUsuario, $codigoSolicitud);
            if(!$arrRespuesta['error']) {
                return $this->view($arrRespuesta['respuesta'], 200);
            } else {
                return $this->view(['mensaje' => $arrRespuesta['errorMensaje']], 400);
            }
        } else {
            return $this->view(['mensaje' => 'Faltan datos para el consumo de la API'], 400);
        }
    }

    #[Route('/api/solicitud/asignar')]
    public function asignar(Request $request, EntityManagerInterface $em) {
        $raw = json_decode($request->getContent(), true);
        $codigoUsuario = $raw['codigoUsuario']?? null;
        $codigoSolicitudAplicacion = $raw['codigoSolicitudAplicacion']?? null;
        if($codigoUsuario && $codigoSolicitudAplicacion) {
            $arrRespuesta = $em->getRepository(Solicitud::class)->asignar($codigoUsuario, $codigoSolicitudAplicacion);
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
