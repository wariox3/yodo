<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240131134823 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE atencion_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE atencion (id INT NOT NULL, celda_id INT DEFAULT NULL, usuario_id INT DEFAULT NULL, fecha TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, descripcion VARCHAR(200) DEFAULT NULL, estado_atendido BOOLEAN DEFAULT false NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_39854FC4EBD6899B ON atencion (celda_id)');
        $this->addSql('CREATE INDEX IDX_39854FC4DB38439E ON atencion (usuario_id)');
        $this->addSql('ALTER TABLE atencion ADD CONSTRAINT FK_39854FC4EBD6899B FOREIGN KEY (celda_id) REFERENCES celda (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE atencion ADD CONSTRAINT FK_39854FC4DB38439E FOREIGN KEY (usuario_id) REFERENCES usuario (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE atencion_id_seq CASCADE');
        $this->addSql('ALTER TABLE atencion DROP CONSTRAINT FK_39854FC4EBD6899B');
        $this->addSql('ALTER TABLE atencion DROP CONSTRAINT FK_39854FC4DB38439E');
        $this->addSql('DROP TABLE atencion');
    }
}
