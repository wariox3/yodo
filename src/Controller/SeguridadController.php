<?php

namespace App\Controller;

use App\Entity\Usuario;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class SeguridadController extends AbstractFOSRestController
{
    #[Route('/api/registro', name: 'api_registro')]
    public function registro(Request $request, EntityManagerInterface $em, UserPasswordHasherInterface $passwordHasher)
    {
        $raw = json_decode($request->getContent(), true);
        $email = $raw['email'] ?? null;
        $password = $raw['password'] ?? null;
        if($email && $password) {
            $arUsuario = $em->getRepository(Usuario::class)->findOneBy(['username' => $email]);
            if($arUsuario == null) {
                $arUsuario = new Usuario();
                $hashedPassword = $passwordHasher->hashPassword($arUsuario, $password);
                $arUsuario->setPassword($hashedPassword);
                $arUsuario->setEmail($email);
                $arUsuario->setUsername($email);
                $em->persist($arUsuario);
                $em->flush();
                return $this->view(['id' => $arUsuario->getId()], 200);
            } else {
                return $this->view([
                    'tipo' => 'error',
                    'errorMensaje' => 'El usuario ya existe',
                ], 400);
            }
        } else {
            return $this->view([
                'tipo' => 'error',
                'errorMensaje' => 'Faltan datos para el consumo de la API',
            ], 400);
        }
    }
}
