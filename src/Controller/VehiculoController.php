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
    #[Route('/api/vehiculo/lista')]
    public function lista(Request $request, EntityManagerInterface $em)
    {
        $raw = json_decode($request->getContent(), true);
        $usuarioId = $raw['usuarioId'] ?? null;
        if ($usuarioId) {
            $arrRespuesta = $em->getRepository(Vehiculo::class)->lista($usuarioId);
            if (!$arrRespuesta['error']) {
                return $this->view($arrRespuesta['respuesta'], 200);
            } else {
                return $this->view(['mensaje' => $arrRespuesta['errorMensaje']], 400);
            }
        } else {
            return $this->view(['mensaje' => 'Faltan datos para el consumo de la API'], 400);
        }
    }

    #[Route('/api/vehiculo/nuevo', methods: ['POST', 'PUT'])]
    public function nuevo(Request $request, EntityManagerInterface $em)
    {
        $raw = json_decode($request->getContent(), true);
        $metodo = $request->getMethod();
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
        if($metodo == 'PUT' && $id == null) {
            return $this->view(['mensaje' => 'Para el metodo PUT debe enviarse el id'], 400);
        } else {
            if ($usuarioId && $modelo && $placa && $marcaId && $lineaId && $carroceriaId && $combustibleId && $configuracionId && $numeroPoliza && $vigenciaPoliza && $vigenciaRevisionTecnica) {
                $arrRespuesta = $em->getRepository(Vehiculo::class)->nuevo($raw, $metodo);
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

    #[Route('/api/vehiculo/detalle')]
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

    #[Route('/api/vehiculo/buscar')]
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