<?php

namespace App\Controller;

use App\Entity\CambioClave;
use App\Entity\Usuario;
use App\Utilidades\Zinc;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class UsuarioController extends AbstractFOSRestController
{
    #[Route('/api/usuario/registro')]
    public function registro(Request $request, EntityManagerInterface $em, UserPasswordHasherInterface $passwordHasher)
    {
        $raw = json_decode($request->getContent(), true);
        $email = $raw['email'] ?? null;
        $password = $raw['password'] ?? null;
        $celular = $raw['celular'] ?? null;
        if($email && $password && $celular) {
            $arUsuario = $em->getRepository(Usuario::class)->findOneBy(['username' => $email]);
            if($arUsuario == null) {
                $usuarioSeparado = explode('@', $email);
                $arUsuario = new Usuario();
                $hashedPassword = $passwordHasher->hashPassword($arUsuario, $password);
                $arUsuario->setPassword($hashedPassword);
                $arUsuario->setEmail($email);
                $arUsuario->setUsername($email);
                $arUsuario->setNombreCorto($usuarioSeparado[0]);
                $arUsuario->setCelular($celular);
                $arUsuario->setImagenPerfil('yodo/perfil/general.png');
                $em->persist($arUsuario);
                $em->flush();
                return $this->view(['id' => $arUsuario->getId()], 200);
            } else {
                return $this->view(['mensaje' => 'El usuario ya existe'], 400);
            }
        } else {
            return $this->view(['mensaje' => 'Faltan datos para el consumo de la API'], 400);
        }
    }

    #[Route('/api/usuario/detalle')]
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

    #[Route('/api/usuario/recuperar_clave')]
    public function recuperarClave(Request $request, EntityManagerInterface $em) {
        $raw = json_decode($request->getContent(), true);
        $usuario = $raw['usuario']?? null;
        if($usuario) {
            $arUsuario = $em->getRepository(Usuario::class)->findOneBy(['username' => $usuario]);
            if($arUsuario) {
                $codigo = mt_rand(100000, 999999);
                $arCambioClave = new CambioClave();
                $arCambioClave->setUsuario($arUsuario);
                $arCambioClave->setCodigo($codigo);
                $arCambioClave->setFecha(new \DateTime('now'));
                $arCambioClave->setEstadoAplicado(false);
                $em->persist($arCambioClave);
                $em->flush();
                $zinc = new Zinc();
                $zinc->enviarCorreoSemantica("Recuperar clave","Se genero un codigo para recuperar la clave: {$codigo}", $usuario);
                return $this->view(['mensaje' => 'Se envia correo recuperacion'], 200);
            } else {
                return $this->view(['mensaje' => 'El usuario no existe'], 400);
            }
        } else {
            return $this->view(['mensaje' => 'Faltan datos para el consumo de la API'], 400);
        }
    }

    #[Route('/api/usuario/cambio_clave')]
    public function cambioClave(Request $request, EntityManagerInterface $em, UserPasswordHasherInterface $passwordHasher) {
        $raw = json_decode($request->getContent(), true);
        $codigo = $raw['codigo']?? null;
        $nuevaClave = $raw['nuevaClave']?? null;
        if($codigo && $nuevaClave) {
            $arCambioClave = $em->getRepository(CambioClave::class)->findOneBy(['codigo' => $codigo]);
            if($arCambioClave) {
                if($arCambioClave->isEstadoAplicado() == false) {
                    $arCambioClave->setEstadoAplicado(true);
                    $em->persist($arCambioClave);
                    $arUsuario = $em->getRepository(Usuario::class)->find($arCambioClave->getUsuarioId());
                    $hashedPassword = $passwordHasher->hashPassword($arUsuario, $nuevaClave);
                    $arUsuario->setPassword($hashedPassword);
                    $em->persist($arUsuario);
                    $em->flush();
                    return $this->view(['mensaje' => 'Se cambio la clave con exito'], 200);
                } else {
                    return $this->view(['mensaje' => 'El codigo ya fue usado para restablecer la clave'], 400);
                }
            } else {
                return $this->view(['mensaje' => 'El codigo es incorrecto'], 400);
            }
        } else {
            return $this->view(['mensaje' => 'Faltan datos para el consumo de la API'], 400);
        }
    }

}
