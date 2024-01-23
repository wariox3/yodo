<?php

namespace App\Repository;

use App\Entity\Ciudad;
use App\Entity\Panal;
use App\Entity\Usuario;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\PasswordUpgraderInterface;
use Symfony\Component\Validator\Constraints\Json;

/**
 * @extends ServiceEntityRepository<Usuario>
 *
 * @implements PasswordUpgraderInterface<Usuario>
 *
 * @method Usuario|null find($id, $lockMode = null, $lockVersion = null)
 * @method Usuario|null findOneBy(array $criteria, array $orderBy = null)
 * @method Usuario[]    findAll()
 * @method Usuario[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UsuarioRepository extends ServiceEntityRepository implements PasswordUpgraderInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Usuario::class);
    }

    /**
     * Used to upgrade (rehash) the user's password automatically over time.
     */
    public function upgradePassword(PasswordAuthenticatedUserInterface $user, string $newHashedPassword): void
    {
        if (!$user instanceof Usuario) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', $user::class));
        }

        $user->setPassword($newHashedPassword);
        $this->getEntityManager()->persist($user);
        $this->getEntityManager()->flush();
    }

    public function detalle($usuario) {
        $em = $this->getEntityManager();
        $queryBuilder = $em->createQueryBuilder()->from(Usuario::class, 'u')
            ->select('u.id')
            ->addSelect('u.nombreCorto')
            ->addSelect('u.email')
            ->addSelect('u.username')
            ->addSelect('u.celular')
            ->addSelect('u.celdaId')
            ->addSelect('u.panalId')
            ->addSelect('c.celda as celdaCelda')
            ->addSelect('p.nombre as panalNombre')
            ->leftJoin('u.celda', 'c')
            ->leftJoin('u.panal', 'p')
            ->where("u.username = '{$usuario}'");
        $arUsuario = $queryBuilder->getQuery()->getOneOrNullResult();
        return $arUsuario;
    }

    public function asignarPanal($codigoUsuario, $codigoPanal, $codigoCiudad) {
        $em = $this->getEntityManager();
        $arUsuario = $em->getRepository(Usuario::class)->find($codigoUsuario);
        if ($arUsuario) {
            if ($arUsuario->getPanal() == null) {
                $arCiudad = $em->getRepository(Ciudad::class)->find($codigoCiudad);
                if ($arCiudad) {
                    $arPanal = $em->getRepository(Panal::class)->find($codigoPanal);
                    if ($arPanal) {
                        $arUsuario->setPanal($arPanal);
                        $arUsuario->setCiudad($arCiudad);
                        $em->persist($arUsuario);
                        $em->flush();
                        return [
                            'error' => false,
                            'respuesta' => [
                                'panal' => $arPanal->getId(),
                                'ciudad' => $arCiudad->getId(),
                                'oferta' => false,
                                'tienda' => false
                            ]
                        ];
                    } else {
                        return [
                            'error' => true,
                            'errorMensaje' => "El panal no existe"
                        ];
                    }
                } else {
                    return [
                        'error' => true,
                        'errorMensaje' => "La ciudad no existe"
                    ];
                }
            } else {
                return [
                    'error' => true,
                    'errorMensaje' => "El usuario ya tiene un panal asignado, debe desvincularse de este panal para seleccionar uno nuevo"
                ];
            }
        } else {
            return [
                'error' => true,
                'errorMensaje' => "El usuario no existe"
            ];
        }
    }
}
