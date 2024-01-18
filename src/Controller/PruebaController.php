<?php

namespace App\Controller;

use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\Routing\Annotation\Route;

class PruebaController extends AbstractFOSRestController
{
    #[Route('/api/inicio', name: 'api_inicio')]
    public function inicio() {
        return $this->view("Inicio de la aplicacion", 200);
    }
}
