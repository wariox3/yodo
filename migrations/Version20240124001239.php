<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240124001239 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE publicacion_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE publicacion (id INT NOT NULL, usuario_id INT NOT NULL, panal_id INT NOT NULL, fecha TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, descripcion VARCHAR(250) DEFAULT NULL, url_imagen VARCHAR(250) NOT NULL, reacciones SMALLINT DEFAULT 0 NOT NULL, comentarios SMALLINT DEFAULT 0 NOT NULL, estado_aprobado BOOLEAN DEFAULT true NOT NULL, permite_comentarios BOOLEAN DEFAULT true NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_62F2085F9AEF6DE6 ON publicacion (panal_id)');
        $this->addSql('CREATE INDEX IDX_62F2085FDB38439E ON publicacion (usuario_id)');
        $this->addSql('ALTER TABLE publicacion ADD CONSTRAINT FK_62F2085F9AEF6DE6 FOREIGN KEY (panal_id) REFERENCES panal (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE publicacion ADD CONSTRAINT FK_62F2085FDB38439E FOREIGN KEY (usuario_id) REFERENCES usuario (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE publicacion_id_seq CASCADE');
        $this->addSql('ALTER TABLE publicacion DROP CONSTRAINT FK_62F2085F9AEF6DE6');
        $this->addSql('ALTER TABLE publicacion DROP CONSTRAINT FK_62F2085FDB38439E');
        $this->addSql('DROP TABLE publicacion');
    }
}
