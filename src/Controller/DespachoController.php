<?php

namespace App\Controller;

use App\Entity\Caso;
use App\Entity\Despacho;
use App\Entity\Operador;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class DespachoController extends AbstractFOSRestController
{
    #[Route('/api/despacho/lista', name: 'api_despacho_lista')]
    public function lista(Request $request, EntityManagerInterface $em)
    {
        $raw = json_decode($request->getContent(), true);
        $codigoUsuario = $raw['codigoUsuario']?? null;
        if($codigoUsuario) {
            $arrRespuesta = $em->getRepository(Despacho::class)->lista($codigoUsuario);
            if(!$arrRespuesta['error']) {
                return $this->view($arrRespuesta['respuesta'], 200);
            } else {
                return $this->view(['mensaje' => $arrRespuesta['errorMensaje']], 400);
            }
        } else {
            return $this->view(['mensaje' => 'Faltan datos para el consumo de la API'], 400);
        }
    }

    #[Route('/api/despacho/nuevo', name: 'api_despacho_nuevo')]
    public function nuevo(Request $request, EntityManagerInterface $em)
    {
        $raw = json_decode($request->getContent(), true);
        $codigoUsuario = $raw['codigoUsuario']?? null;
        $operador = $raw['operador']?? null;
        $codigoDespacho = $raw['codigoDespacho']?? null;
        $token = $raw['token']?? null;
        if($codigoUsuario && $operador && $codigoDespacho && $token) {
            $arrRespuesta = $em->getRepository(Despacho::class)->nuevo($codigoUsuario, $operador, $codigoDespacho, $token);
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