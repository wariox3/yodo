<?php

namespace App\Controller;

use App\Entity\Ciudad;
use App\Entity\Panal;
use App\Entity\Publicacion;
use App\Entity\Usuario;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class PublicacionController extends AbstractFOSRestController
{
    #[Route('/api/publicacion/lista/{codigoUsuario}/{pagina}', methods: ['GET'] )]
    public function lista(Request $request, EntityManagerInterface $em, PaginatorInterface $paginator, $codigoUsuario, $pagina = 1) {
        if($codigoUsuario) {
            $arUsuario = $em->getRepository(Usuario::class)->find($codigoUsuario);
            if($arUsuario) {
                if($arUsuario->getPanal()) {
                    $query = $em->getRepository(Publicacion::class)->queryLista($arUsuario->getPanalId());
                    $arPublicaciones = $paginator->paginate($query, $request->query->getInt('page', $pagina), 10);
                    return $this->view([
                        'publicaciones' => $arPublicaciones
                    ], 200);
                } else {
                    return $this->view(['mensaje' => 'El usuario no tiene panal'], 400);
                }
            } else {
                return $this->view(['mensaje' => 'El usuario no existe'], 400);
            }
        } else {
            return $this->view(['mensaje' => 'Faltan datos para el consumo de la API'], 400);
        }
    }
}
