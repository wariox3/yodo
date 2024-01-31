<?php

namespace App\Controller;

use App\Entity\Reserva;
use App\Entity\ReservaDetalle;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class reservaController extends AbstractFOSRestController
{
    #[Route('/api/reserva/lista', name: 'api_reserva_lista')]
    public function lista(Request $request, EntityManagerInterface $em)
    {
        $raw = json_decode($request->getContent(), true);
        $codigoPanal = $raw['codigoPanal'] ?? null;
        if ($codigoPanal) {
            $arrRespuesta = $em->getRepository(Reserva::class)->lista($codigoPanal);
            if (!$arrRespuesta['error']) {
                return $this->view($arrRespuesta['respuesta'], 200);
            } else {
                return $this->view(['mensaje' => $arrRespuesta['errorMensaje']], 400);
            }
        } else {
            return $this->view(['mensaje' => 'Faltan datos para el consumo de la API'], 400);
        }
    }

    #[Route('/api/reserva/detallelista', name: 'api_reserva_detallelista')]
    public function detalleLista(Request $request, EntityManagerInterface $em)
    {
        $raw = json_decode($request->getContent(), true);
        $codigoCelda = $raw['codigoCelda'] ?? null;
        if ($codigoCelda) {
            $arrRespuesta = $em->getRepository(ReservaDetalle::class)->lista($codigoCelda);
            if (!$arrRespuesta['error']) {
                return $this->view($arrRespuesta['respuesta'], 200);
            } else {
                return $this->view(['mensaje' => $arrRespuesta['errorMensaje']], 400);
            }
        } else {
            return $this->view(['mensaje' => 'Faltan datos para el consumo de la API'], 400);
        }
    }

    #[Route('/api/reserva/detallenuevo', name: 'api_reserva_detallenuevo')]
    public function detalleNuevo(Request $request, EntityManagerInterface $em)
    {
        $raw = json_decode($request->getContent(), true);
        $codigoCelda = $raw['codigoCelda']?? null;
        $codigoReserva = $raw['codigoReserva']?? null;
        $fecha = $raw['fecha']?? null;
        $comentario = $raw['comentario']?? null;
        if($codigoCelda && $codigoReserva && $fecha) {
            $arrRespuesta = $em->getRepository(ReservaDetalle::class)->nuevo($codigoCelda, $codigoReserva, $fecha, $comentario);
            if (!$arrRespuesta['error']) {
                return $this->view($arrRespuesta['respuesta'], 200);
            } else {
                return $this->view(['mensaje' => $arrRespuesta['errorMensaje']], 400);
            }
        } else {
            return $this->view(['mensaje' => 'Faltan datos para el consumo de la API'], 400);
        }
    }

    #[Route('/api/reserva/reserva', name: 'api_reserva_reserva')]
    public function reserva(Request $request, EntityManagerInterface $em)

    {
        $raw = json_decode($request->getContent(), true);
        $codigoReserva = $raw['codigoReserva'] ?? null;
        $anio = $raw['anio'] ?? null;
        $mes = $raw['mes'] ?? null;
        if ($codigoReserva && $anio && $mes) {
            $arrRespuesta = $em->getRepository(ReservaDetalle::class)->reserva($codigoReserva, $anio, $mes);
            if (!$arrRespuesta['error']) {
                return $this->view($arrRespuesta['respuesta'], 200);
            } else {
                return $this->view(['mensaje' => $arrRespuesta['errorMensaje']], 400);
            }
        } else {
            return $this->view(['mensaje' => 'Faltan datos para el consumo de la API'], 400);
        }
    }


}