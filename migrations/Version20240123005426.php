<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240123005426 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE celda_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE panal_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE celda (id INT NOT NULL, panal_id INT DEFAULT NULL, celda VARCHAR(20) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_6EA130989AEF6DE6 ON celda (panal_id)');
        $this->addSql('CREATE TABLE panal (id INT NOT NULL, nombre VARCHAR(100) NOT NULL, correo VARCHAR(100) NOT NULL, direccion VARCHAR(300) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE celda ADD CONSTRAINT FK_6EA130989AEF6DE6 FOREIGN KEY (panal_id) REFERENCES panal (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE celda_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE panal_id_seq CASCADE');
        $this->addSql('ALTER TABLE celda DROP CONSTRAINT FK_6EA130989AEF6DE6');
        $this->addSql('DROP TABLE celda');
        $this->addSql('DROP TABLE panal');
    }
}
