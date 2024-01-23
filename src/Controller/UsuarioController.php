<?php

namespace App\Controller;

use App\Entity\Usuario;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class UsuarioController extends AbstractFOSRestController
{
    #[Route('/api/usuario/detalle', name: 'api_usuario_detalle')]
    public function detalle(Request $request, EntityManagerInterface $em) {
        $raw = json_decode($request->getContent(), true);
        $codigoUsuario = $raw['codigoUsuario']?? null;
        if($codigoUsuario) {
            $usuario = $em->getRepository(Usuario::class)->detalle($codigoUsuario);
            return $this->view(['usuario' => $usuario], 200);
        } else {
            return $this->view([
                'tipo' => 'error',
                'errorMensaje' => 'Faltan datos para el consumo de la API',
            ], 400);
        }
    }
}
