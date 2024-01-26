<?php

namespace App\Controller;

use App\Entity\Visita;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class VisitaController extends AbstractFOSRestController
{
    #[Route('/api/visita/lista', name: 'api_visita_lista')]
    public function lista(Request $request, EntityManagerInterface $em) {
        $raw = json_decode($request->getContent(), true);
        $codigoCelda = $raw['codigoCelda']?? null;
        if($codigoCelda) {
            $arrRespuesta = $em->getRepository(Visita::class)->lista($codigoCelda);
            if(!$arrRespuesta['error']) {
                return $this->view($arrRespuesta['respuesta'], 200);
            } else {
                return $this->view(['mensaje' => $arrRespuesta['errorMensaje']], 400);
            }
        } else {
            return $this->view(['mensaje' => 'Faltan datos para el consumo de la API'], 400);
        }
    }

    #[Route('/api/visita/nuevo', name: 'api_visita_nuevo')]
    public function nuevo(Request $request, EntityManagerInterface $em) {
        $raw = json_decode($request->getContent(), true);
        $codigoPanal = $raw['codigoPanal']?? null;
        $celda = $raw['celda']?? null;
        if($codigoPanal && $celda) {
            $arrRespuesta = $em->getRepository(Visita::class)->nuevo($raw);
            if(!$arrRespuesta['error']) {
                return $this->view($arrRespuesta['respuesta'], 200);
            } else {
                return $this->view(['mensaje' => $arrRespuesta['errorMensaje']], 400);
            }
        } else {
            return $this->view(['mensaje' => 'Faltan datos para el consumo de la API'], 400);
        }
    }

    #[Route('/api/visita/detalle', name: 'api_visita_detalle')]
    public function visita(Request $request, EntityManagerInterface $em) {
        $raw = json_decode($request->getContent(), true);
        $codigoVisita = $raw['codigoVisita']?? null;
        if($codigoVisita) {
            $arrRespuesta = $em->getRepository(Visita::class)->detalle($codigoVisita);
            if(!$arrRespuesta['error']) {
                return $this->view($arrRespuesta['respuesta'], 200);
            } else {
                return $this->view(['mensaje' => $arrRespuesta['errorMensaje']], 400);
            }
        } else {
            return $this->view(['mensaje' => 'Faltan datos para el consumo de la API'], 400);
        }
    }

    #[Route('/api/visita/pendiente', name: 'api_visita_pendiente')]
    public function pendiente(Request $request, EntityManagerInterface $em) {
        $raw = json_decode($request->getContent(), true);
        $codigoPanal = $raw['codigoPanal']?? null;
        $celda = $raw['celda']?? null;
        $estadoAutorizado = $raw['estadoAutorizado']?? null;
        $codigoIngreso = $raw['codigoIngreso']?? null;
        if($codigoPanal) {
            $arrRespuesta = $em->getRepository(Visita::class)->pendiente($codigoPanal, $celda, $estadoAutorizado, $codigoIngreso);
            if(!$arrRespuesta['error']) {
                return $this->view($arrRespuesta['respuesta'], 200);
            } else {
                return $this->view(['mensaje' => $arrRespuesta['errorMensaje']], 400);
            }
        } else {
            return $this->view(['mensaje' => 'Faltan datos para el consumo de la API'], 400);
        }
    }

    #[Route('/api/visita/autorizar', name: 'api_visita_autorizar')]
    public function autorizar(Request $request, EntityManagerInterface $em) {
        $raw = json_decode($request->getContent(), true);
        $codigoVisita = $raw['codigoVisita']?? null;
        $codigoUsuario = $raw['codigoUsuario']?? null;
        if($codigoVisita && $codigoUsuario) {
            $arrRespuesta = $em->getRepository(Visita::class)->autorizar($codigoVisita, $codigoUsuario);
            if(!$arrRespuesta['error']) {
                return $this->view($arrRespuesta['respuesta'], 200);
            } else {
                return $this->view(['mensaje' => $arrRespuesta['errorMensaje']], 400);
            }
        } else {
            return $this->view(['mensaje' => 'Faltan datos para el consumo de la API'], 400);
        }
    }

    #[Route('/api/visita/cerrar', name: 'api_visita_cerrar')]
    public function cerrar(Request $request, EntityManagerInterface $em) {
        $raw = json_decode($request->getContent(), true);
        $codigoVisita = $raw['codigoVisita']?? null;
        $codigoUsuario = $raw['codigoUsuario']?? null;
        if($codigoVisita && $codigoUsuario) {
            $arrRespuesta = $em->getRepository(Visita::class)->cerrar($codigoVisita, $codigoUsuario);
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
