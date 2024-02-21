<?php

namespace App\Controller;

use App\Entity\Guia;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class GuiaController extends AbstractFOSRestController
{
    #[Route('/api/guia/entrega', name: 'api_guia_entrega')]
    public function entrega(Request $request, EntityManagerInterface $em)
    {
        $raw = json_decode($request->getContent(), true);
        $guia = $raw['codigoGuia']?? null;
        $usuario = $raw['usuario']?? null;
        if($guia && $usuario) {
            $arrRespuesta = $em->getRepository(Guia::class)->entrega($raw);
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