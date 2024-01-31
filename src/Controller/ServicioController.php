<?php

namespace App\Controller;

use App\Entity\Servicio;
use App\Entity\Visita;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ServicioController extends AbstractFOSRestController
{
    #[Route('/api/servicio/pendiente', name: 'api_servicio_pendiente')]
    public function pendiente(EntityManagerInterface $em) {
        $arrRespuesta = $em->getRepository(Servicio::class)->pendiente();
        if(!$arrRespuesta['error']) {
            return $this->view($arrRespuesta['respuesta'], 200);
        } else {
            return $this->view(['mensaje' => $arrRespuesta['errorMensaje']], 400);
        }
    }
}
