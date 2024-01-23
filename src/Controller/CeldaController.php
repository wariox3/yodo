<?php

namespace App\Controller;

use App\Entity\Celda;
use App\Entity\Ciudad;
use App\Entity\Panal;
use App\Entity\Usuario;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CeldaController extends AbstractFOSRestController
{
    #[Route('/api/panal/buscar', name: 'api_celda_buscar')]
    public function buscar(Request $request, EntityManagerInterface $em) {
        $raw = json_decode($request->getContent(), true);
        $codigoCiudad = $raw['codigoCiudad']?? null;
        $arrRespuesta = $em->getRepository(Panal::class)->buscar($codigoCiudad);
        if(!$arrRespuesta['error']) {
            return $this->view([
                'panales' => $arrRespuesta['respuesta']
            ], 200);
        } else {
            return $this->view(['mensaje' => $arrRespuesta['errorMensaje']], 400);
        }
    }

    #[Route('/api/celda/vincular', name: 'api_celda_vincular')]
    public function vincular(Request $request, EntityManagerInterface $em) {
        $raw = json_decode($request->getContent(), true);
        $codigoUsuario = $raw['codigoUsuario']?? null;
        $codigoPanal = $raw['codigoPanal']?? null;
        $celda = $raw['celda']?? null;
        $llave = $raw['llave']?? null;
        if($codigoUsuario && $codigoPanal && $celda && $llave) {
            $arrRespuesta = $em->getRepository(Celda::class)->vincular($codigoUsuario, $codigoPanal, $celda, $llave);
            if(!$arrRespuesta['error']) {
                return $this->view($arrRespuesta['respuesta'], 200);
            } else {
                return $this->view(['mensaje' => $arrRespuesta['errorMensaje']], 400);
            }
        } else {
            return $this->view(['mensaje' => 'Faltan datos para el consumo de la API'], 400);
        }
    }

    #[Route('/api/celda/desvincular', name: 'api_celda_desvincular')]
    public function desvincular(Request $request, EntityManagerInterface $em) {
        $raw = json_decode($request->getContent(), true);
        $codigoUsuario = $raw['codigoUsuario']?? null;
        if($codigoUsuario) {
            $arrRespuesta = $em->getRepository(Celda::class)->desvincular($codigoUsuario);
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
