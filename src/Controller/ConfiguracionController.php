<?php

namespace App\Controller;

use App\Entity\Configuracion;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ConfiguracionController extends AbstractFOSRestController
{
    #[Route('/api/configuracion/lista', name: 'api_configuracion_lista')]
    public function lista(Request $request, EntityManagerInterface $em)
    {
        $arrRespuesta = $em->getRepository(Configuracion::class)->lista();
        if(!$arrRespuesta['error']) {
            return $this->view($arrRespuesta['respuesta'], 200);
        } else {
            return $this->view(['mensaje' => $arrRespuesta['errorMensaje']], 400);
        }
    }
}