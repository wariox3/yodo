<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240131155157 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE contenido_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE contenido (id INT NOT NULL, panal_id INT DEFAULT NULL, nombre VARCHAR(200) DEFAULT NULL, nombre_archivo VARCHAR(200) DEFAULT NULL, url VARCHAR(500) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_D0A7397F9AEF6DE6 ON contenido (panal_id)');
        $this->addSql('ALTER TABLE contenido ADD CONSTRAINT FK_D0A7397F9AEF6DE6 FOREIGN KEY (panal_id) REFERENCES panal (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE contenido_id_seq CASCADE');
        $this->addSql('ALTER TABLE contenido DROP CONSTRAINT FK_D0A7397F9AEF6DE6');
        $this->addSql('DROP TABLE contenido');
    }
}
