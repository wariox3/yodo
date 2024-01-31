<?php

namespace App\Controller;

use App\Entity\Solicitud;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class SolicitudController extends AbstractFOSRestController
{
    #[Route('/api/solicitud/pendiente', name: 'api_solicitud_pendiente')]
    public function pendiente(EntityManagerInterface $em) {
        $arrRespuesta = $em->getRepository(Solicitud::class)->pendiente();
        if(!$arrRespuesta['error']) {
            return $this->view($arrRespuesta['respuesta'], 200);
        } else {
            return $this->view(['mensaje' => $arrRespuesta['errorMensaje']], 400);
        }
    }

    #[Route('/api/solicitud/aplicar', name: 'api_solicitud_aplicar')]
    public function aplicar(Request $request, EntityManagerInterface $em) {
        $raw = json_decode($request->getContent(), true);
        $codigoUsuario = $raw['codigoUsuario']?? null;
        if($codigoUsuario) {
            $arrRespuesta = $em->getRepository(Solicitud::class)->aplicar($codigoUsuario);
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
