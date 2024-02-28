<?php

namespace App\Controller;

use App\Entity\Carroceria;
use App\Entity\Linea;
use App\Entity\Marca;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class LineaController extends AbstractFOSRestController
{
    #[Route('/api/linea/buscar', name: 'api_linea_buscar')]
    public function buscar(Request $request, EntityManagerInterface $em) {
        $raw = json_decode($request->getContent(), true);
        $nombre = $raw['nombre']?? null;
        $codigoMarca = $raw['codigoMarca']?? null;
        if($codigoMarca){
            $arrRespuesta = $em->getRepository(Linea::class)->buscar($codigoMarca, $nombre);
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