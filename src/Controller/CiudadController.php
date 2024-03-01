<?php

namespace App\Controller;

use App\Entity\Ciudad;
use App\Entity\Usuario;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CiudadController extends AbstractFOSRestController
{
    #[Route('/api/ciudad/buscar')]
    public function buscar(Request $request, EntityManagerInterface $em) {
        $raw = json_decode($request->getContent(), true);
        $arrRespuesta = $em->getRepository(Ciudad::class)->buscar();
        if(!$arrRespuesta['error']) {
            return $this->view([
                'ciudades' => $arrRespuesta['respuesta']
            ], 200);
        } else {
            return $this->view(['mensaje' => $arrRespuesta['errorMensaje']], 400);
        }
    }
}
