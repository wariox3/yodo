<?php

namespace App\Controller;

use App\Entity\Soporte;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class SoporteController extends AbstractFOSRestController
{
    #[Route('/api/soporte/nuevo')]
    public function nuevo(Request $request, EntityManagerInterface $em)
    {
        $raw = json_decode($request->getContent(), true);
        $codigoUsuario = $raw['codigoUsuario'] ?? null;
        $descripcion = $raw['descripcion'] ?? null;
        if($codigoUsuario && $descripcion) {
            $arrRespuesta = $em->getRepository(Soporte::class)->nuevo($codigoUsuario, $descripcion);
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