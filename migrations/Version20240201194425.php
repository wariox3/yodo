<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240201194425 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE conductor (id INT NOT NULL, nombre VARCHAR(150) NOT NULL, numero_identificacion VARCHAR(20) DEFAULT NULL, fecha_nacimiento TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, alias VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE vehiculo (id INT NOT NULL, modelo VARCHAR(255) NOT NULL, plata VARCHAR(10) NOT NULL, PRIMARY KEY(id))');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP TABLE conductor');
        $this->addSql('DROP TABLE vehiculo');
    }
}