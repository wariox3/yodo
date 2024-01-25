<?php

namespace App\Controller;

use App\Entity\Celda;
use App\Entity\Ciudad;
use App\Entity\Entrega;
use App\Entity\Panal;
use App\Entity\Usuario;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class EntregaController extends AbstractFOSRestController
{
    #[Route('/api/entrega/lista', name: 'api_entrega_lista')]
    public function lista(Request $request, EntityManagerInterface $em) {
        $raw = json_decode($request->getContent(), true);
        $codigoCelda = $raw['codigoCelda']?? null;
        if($codigoCelda) {
            $arrRespuesta = $em->getRepository(Entrega::class)->lista($codigoCelda);
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
