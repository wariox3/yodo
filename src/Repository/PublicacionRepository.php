<?php

namespace App\Repository;

use App\Entity\Celda;
use App\Entity\CeldaUsuario;
use App\Entity\Panal;
use App\Entity\Publicacion;
use App\Entity\Usuario;
use App\Entity\Visita;
use App\Utilidades\BackBlaze;
use App\Utilidades\Firebase;
use App\Utilidades\General;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;


class PublicacionRepository extends ServiceEntityRepository
{
    private $general;
    public function __construct(ManagerRegistry $registry, General $general)
    {
        parent::__construct($registry, Publicacion::class);
        $this->general = $general;
    }

    public function queryLista($codigoPanal)
    {
        $em = $this->getEntityManager();
        $queryBuilder = $em->createQueryBuilder()->from(Publicacion::class, 'p')
            ->select('p.id')
            ->addSelect('p.fecha')
            ->addSelect('p.descripcion')
            ->addSelect("CONCAT('{$_ENV['B2_RUTA']}', p.urlImagen) as urlImagen")
            ->addSelect('p.reacciones')
            ->addSelect('p.comentarios')
            ->addSelect('p.permiteComentarios')
            ->addSelect('p.usuarioId')
            ->addSelect("CONCAT('{$_ENV['B2_RUTA']}', u.imagenPerfil) as usuarioImagenPerfil")
            ->addSelect('u.username as usuarioUsername')
            ->addSelect('u.nombreCorto as usuarioNombreCorto')
            ->leftJoin('p.usuario', 'u')
            ->where("p.panalId = {$codigoPanal}")
            ->andWhere("p.estadoAprobado = true")
            ->orderBy('p.fecha', 'DESC');
        return $queryBuilder;
    }

    public function nuevo($raw)
    {
        $em = $this->getEntityManager();
        $codigoUsuario = $raw['codigoUsuario']?? null;
        $imagen = $raw['imagenBase64']?? null;
        $arUsuario = $em->getRepository(Usuario::class)->find($codigoUsuario);
        if($arUsuario) {
            $arPublicacion = new Publicacion();
            $arPublicacion->setUsuario($arUsuario);
            $arPublicacion->setPanal($arUsuario->getPanal());
            $arPublicacion->setFecha(new \DateTime('now'));
            $arPublicacion->setUrlImagen("");
            $em->persist($arPublicacion);
            $em->flush();
            $partesArchivo = $this->general->desfragmentarArchivoBase64($imagen);
            $nombre = "publicacion/{$arPublicacion->getId()}.{$partesArchivo['extension']}";
            $dataBinario = base64_decode($partesArchivo['base64']);
            $backBlaze = new BackBlaze();
            $backBlaze->subirB64($nombre, $dataBinario, $partesArchivo['mimeType']);
            $arPublicacion->setUrlImagen("{$_ENV['B2_BUCKET_NAME']}/{$nombre}");
            $em->persist($arPublicacion);
            $em->flush();
            return [
                'error' => false,
                'respuesta' => [
                    'id' => $arPublicacion->getId()
                ]
            ];

        } else {
            return [
                'error' => true,
                'errorMensaje' => "No existe el usuario"
            ];
        }
    }

}