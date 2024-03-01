<?php

namespace App\Controller;

use App\Entity\Marca;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class MarcaController extends AbstractFOSRestController
{
    #[Route('/api/marca/buscar')]
    public function buscar(Request $request, EntityManagerInterface $em) {
        $raw = json_decode($request->getContent(), true);
        $nombre = $raw['nombre']?? null;
        $arrRespuesta = $em->getRepository(Marca::class)->buscar($nombre);
        if(!$arrRespuesta['error']) {
            return $this->view($arrRespuesta['respuesta'], 200);
        } else {
            return $this->view(['mensaje' => $arrRespuesta['errorMensaje']], 400);
        }
    }

}