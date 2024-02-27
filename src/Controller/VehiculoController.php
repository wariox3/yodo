<?php

namespace App\Controller;

use App\Entity\Soporte;
use App\Entity\Vehiculo;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class VehiculoController extends AbstractFOSRestController
{
    #[Route('/api/vehiculo/lista', name: 'api_vehiculo_lista')]
    public function lista(Request $request, EntityManagerInterface $em)
    {
        $raw = json_decode($request->getContent(), true);
        $usuarioId = $raw['usuarioId'] ?? null;
        if ($usuarioId) {
            $arrRespuesta = $em->getRepository(Vehiculo::class)->lista();
            if (!$arrRespuesta['error']) {
                return $this->view($arrRespuesta['respuesta'], 200);
            } else {
                return $this->view(['mensaje' => $arrRespuesta['errorMensaje']], 400);
            }
        } else {
            return $this->view(['mensaje' => 'Faltan datos para el consumo de la API'], 400);
        }
    }

    #[Route('/api/vehiculo/nuevo', name: 'api_vehiculo_nuevo')]
    public function nuevo(Request $request, EntityManagerInterface $em)
    {
        $raw = json_decode($request->getContent(), true);
        $modelo = $raw['modelo'] ?? null;
        $placa = $raw['placa'] ?? null;
        if ($modelo && $placa) {
            $arrRespuesta = $em->getRepository(Vehiculo::class)->nuevo($modelo, $placa);
            if (!$arrRespuesta['error']) {
                return $this->view($arrRespuesta['respuesta'], 200);
            } else {
                return $this->view(['mensaje' => $arrRespuesta['errorMensaje']], 400);
            }
        } else {
            return $this->view(['mensaje' => 'Faltan datos para el consumo de la API'], 400);
        }
    }

    #[Route('/api/vehiculo/detalle', name: 'api_vehiculo_detalle')]
    public function detalle(Request $request, EntityManagerInterface $em)
    {
        $raw = json_decode($request->getContent(), true);
        $codigoVehiculo = $raw['codigoVehiculo'] ?? null;
        if ($codigoVehiculo) {
            $arrRespuesta = $em->getRepository(Vehiculo::class)->detalle($codigoVehiculo);
            if (!$arrRespuesta['error']) {
                return $this->view($arrRespuesta['respuesta'], 200);
            } else {
                return $this->view(['mensaje' => $arrRespuesta['errorMensaje']], 400);
            }
        } else {
            return $this->view(['mensaje' => 'Faltan datos para el consumo de la API'], 400);
        }
    }

    #[Route('/api/vehiculo/buscar', name: 'api_vehiculo_buscar')]
    public function buscar(Request $request, EntityManagerInterface $em)
    {
        $raw = json_decode($request->getContent(), true);
        $arrRespuesta = $em->getRepository(Vehiculo::class)->buscar();
        if (!$arrRespuesta['error']) {
            return $this->view($arrRespuesta['respuesta'], 200);
        } else {
            return $this->view(['mensaje' => $arrRespuesta['errorMensaje']], 400);
        }
    }
}