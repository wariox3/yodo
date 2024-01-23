<?php

namespace App\Controller;

use App\Entity\Ciudad;
use App\Entity\Panal;
use App\Entity\Usuario;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class PanalController extends AbstractFOSRestController
{
    #[Route('/api/panal/buscar', name: 'api_panal_buscar')]
    public function buscar(Request $request, EntityManagerInterface $em) {
        $raw = json_decode($request->getContent(), true);
        $codigoCiudad = $raw['codigoCiudad']?? null;
        $arrRespuesta = $em->getRepository(Panal::class)->buscar($codigoCiudad);
        if(!$arrRespuesta['error']) {
            return $this->view([
                'panales' => $arrRespuesta['respuesta']
            ], 200);
        } else {
            return $this->view(['mensaje' => $arrRespuesta['errorMensaje']], 400);
        }
    }
}
