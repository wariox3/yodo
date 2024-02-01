<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240131233917 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE solicitud_aplicacion_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE solicitud_aplicacion (id INT NOT NULL, usuario_id INT NOT NULL, solicitud_id INT NOT NULL, fecha TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, estado_asignado BOOLEAN DEFAULT false NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_4527A584DB38439E ON solicitud_aplicacion (usuario_id)');
        $this->addSql('CREATE INDEX IDX_4527A5841CB9D6E4 ON solicitud_aplicacion (solicitud_id)');
        $this->addSql('ALTER TABLE solicitud_aplicacion ADD CONSTRAINT FK_4527A584DB38439E FOREIGN KEY (usuario_id) REFERENCES usuario (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE solicitud_aplicacion ADD CONSTRAINT FK_4527A5841CB9D6E4 FOREIGN KEY (solicitud_id) REFERENCES solicitud (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE solicitud ADD usuario_asignado_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE solicitud ADD CONSTRAINT FK_96D27CC07BB06BE1 FOREIGN KEY (usuario_asignado_id) REFERENCES usuario (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_96D27CC07BB06BE1 ON solicitud (usuario_asignado_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE solicitud_aplicacion_id_seq CASCADE');
        $this->addSql('ALTER TABLE solicitud_aplicacion DROP CONSTRAINT FK_4527A584DB38439E');
        $this->addSql('ALTER TABLE solicitud_aplicacion DROP CONSTRAINT FK_4527A5841CB9D6E4');
        $this->addSql('DROP TABLE solicitud_aplicacion');
        $this->addSql('ALTER TABLE solicitud DROP CONSTRAINT FK_96D27CC07BB06BE1');
        $this->addSql('DROP INDEX IDX_96D27CC07BB06BE1');
        $this->addSql('ALTER TABLE solicitud DROP usuario_asignado_id');
    }
}
