<?php

namespace App\Controller;

use App\Entity\Caso;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CasoController extends AbstractFOSRestController
{
    #[Route('/api/caso/lista')]
    public function lista(Request $request, EntityManagerInterface $em) {
        $raw = json_decode($request->getContent(), true);
        $codigoPanal = $raw['codigoPanal']?? null;
        $codigoUsuario = $raw['codigoUsuario']?? null;
        if($codigoPanal && $codigoUsuario) {
            $arrRespuesta = $em->getRepository(Caso::class)->lista($codigoPanal, $codigoUsuario);
            if(!$arrRespuesta['error']) {
                return $this->view($arrRespuesta['respuesta'], 200);
            } else {
                return $this->view(['mensaje' => $arrRespuesta['errorMensaje']], 400);
            }
        } else {
            return $this->view(['mensaje' => 'Faltan datos para el consumo de la API'], 400);
        }
    }


    #[Route('/api/caso/nuevo')]
    public function nuevo(Request $request, EntityManagerInterface $em)
    {
        $raw = json_decode($request->getContent(), true);
        $codigoUsuario = $raw['codigoUsuario']?? null;
        $tipo = $raw['tipo']?? null;
        $descripcion = $raw['descripcion']?? null;
        if($codigoUsuario && $descripcion && $tipo) {
            $arrRespuesta = $em->getRepository(Caso::class)->nuevo($tipo, $codigoUsuario, $descripcion);
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