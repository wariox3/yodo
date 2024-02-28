<?php

namespace App\Controller;

use App\Entity\Carroceria;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CarroceriaController extends AbstractFOSRestController
{
    #[Route('/api/carroceria/buscar', name: 'api_carroceria_buscar')]
    public function buscar(Request $request, EntityManagerInterface $em) {
        $raw = json_decode($request->getContent(), true);
        $nombre = $raw['nombre']?? null;
        $arrRespuesta = $em->getRepository(Carroceria::class)->buscar($nombre);
        if(!$arrRespuesta['error']) {
            return $this->view($arrRespuesta['respuesta'], 200);
        } else {
            return $this->view(['mensaje' => $arrRespuesta['errorMensaje']], 400);
        }
    }

}