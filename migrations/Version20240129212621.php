<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240129212621 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE caso_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE caso_tipo_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE caso (id INT NOT NULL, caso_tipo_id INT DEFAULT NULL, panal_id INT DEFAULT NULL, usuario_id INT DEFAULT NULL, fecha TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, fecha_atendido TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, fecha_cerrado TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, descripcion TEXT DEFAULT NULL, nombre VARCHAR(200) NOT NULL, correo VARCHAR(200) NOT NULL, celular VARCHAR(200) DEFAULT NULL, estado_atendido BOOLEAN DEFAULT false NOT NULL, estado_cerrado BOOLEAN DEFAULT false NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_98DD701A93AA11F9 ON caso (caso_tipo_id)');
        $this->addSql('CREATE INDEX IDX_98DD701A9AEF6DE6 ON caso (panal_id)');
        $this->addSql('CREATE INDEX IDX_98DD701ADB38439E ON caso (usuario_id)');
        $this->addSql('CREATE TABLE caso_tipo (id INT NOT NULL, nombre VARCHAR(20) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE caso ADD CONSTRAINT FK_98DD701A93AA11F9 FOREIGN KEY (caso_tipo_id) REFERENCES caso_tipo (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE caso ADD CONSTRAINT FK_98DD701A9AEF6DE6 FOREIGN KEY (panal_id) REFERENCES panal (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE caso ADD CONSTRAINT FK_98DD701ADB38439E FOREIGN KEY (usuario_id) REFERENCES usuario (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE caso_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE caso_tipo_id_seq CASCADE');
        $this->addSql('ALTER TABLE caso DROP CONSTRAINT FK_98DD701A93AA11F9');
        $this->addSql('ALTER TABLE caso DROP CONSTRAINT FK_98DD701A9AEF6DE6');
        $this->addSql('ALTER TABLE caso DROP CONSTRAINT FK_98DD701ADB38439E');
        $this->addSql('DROP TABLE caso');
        $this->addSql('DROP TABLE caso_tipo');
    }
}
