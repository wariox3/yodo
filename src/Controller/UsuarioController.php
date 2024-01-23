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
        $usuario = $raw['usuario']?? null;
        $tokenFirebase = $raw['tokenFirebase']?? null;
        if($usuario) {
            $arrUsuario = $em->getRepository(Usuario::class)->detalle($usuario);
            if($arrUsuario && $tokenFirebase) {
                $arUsuario = $em->getRepository(Usuario::class)->find($arrUsuario['id']);
                if($arUsuario) {
                    $arUsuario->setTokenFirebase($tokenFirebase);
                    $em->persist($arUsuario);
                    $em->flush();
                }
            }
            return $this->view(['usuario' => $arrUsuario], 200);
        } else {
            return $this->view(['mensaje' => 'Faltan datos para el consumo de la API'], 400);
        }
    }
}
