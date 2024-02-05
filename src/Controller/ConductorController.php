<?php

namespace App\Controller;

use App\Entity\Conductor;
use App\Entity\Soporte;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ConductorController extends AbstractFOSRestController
{
    #[Route('/api/conductor/lista', name: 'api_conductor_lista')]
    public function lista(Request $request, EntityManagerInterface $em)
    {
        $raw = json_decode($request->getContent(), true);
        $arrRespuesta = $em->getRepository(Conductor::class)->lista();
        if(!$arrRespuesta['error']) {
            return $this->view($arrRespuesta['respuesta'], 200);
        } else {
            return $this->view(['mensaje' => $arrRespuesta['errorMensaje']], 400);
        }
    }

    #[Route('/api/conductor/nuevo', name: 'api_conductor_nuevo')]
    public function nuevo(Request $request, EntityManagerInterface $em)
    {
        $raw = json_decode($request->getContent(), true);
        $nombre = $raw['nombre'] ?? null;
        $alias = $raw['alias'] ?? null;
        $fechaNacimiento = $raw['fechaNacimiento'] ?? null;
        $numeroIdentificacion = $raw['numeroIdentificacion'] ?? null;
        if($nombre && $alias && $fechaNacimiento && $numeroIdentificacion) {
            $arrRespuesta = $em->getRepository(Conductor::class)->nuevo($nombre, $alias, $fechaNacimiento, $numeroIdentificacion);
            if(!$arrRespuesta['error']) {
                return $this->view($arrRespuesta['respuesta'], 200);
            } else {
                return $this->view(['mensaje' => $arrRespuesta['errorMensaje']], 400);
            }
        } else {
            return $this->view(['mensaje' => 'Faltan datos para el consumo de la API'], 400);
        }
    }

    #[Route('/api/conductor/detalle', name: 'api_conductor_detalle')]
    public function detalle(Request $request, EntityManagerInterface $em)
    {
        $raw = json_decode($request->getContent(), true);
        $codigoConductor = $raw['codigoConductor'] ?? null;
        if ($codigoConductor) {
            $arrRespuesta = $em->getRepository(Conductor::class)->detalle($codigoConductor);
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