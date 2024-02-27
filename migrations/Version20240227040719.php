<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240227040719 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE configuracion (id INT NOT NULL, nombre VARCHAR(20) NOT NULL, descripcion VARCHAR(100) NOT NULL, tipo VARCHAR(50) NOT NULL, peso_minimo INT DEFAULT 0 NOT NULL, peso_maximo INT DEFAULT 0 NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE vehiculo ADD configuracion_id INT NOT NULL');
        $this->addSql('ALTER TABLE vehiculo ADD CONSTRAINT FK_C9FA1603D18A8F98 FOREIGN KEY (configuracion_id) REFERENCES configuracion (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_C9FA1603D18A8F98 ON vehiculo (configuracion_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE vehiculo DROP CONSTRAINT FK_C9FA1603D18A8F98');
        $this->addSql('DROP TABLE configuracion');
        $this->addSql('DROP INDEX IDX_C9FA1603D18A8F98');
        $this->addSql('ALTER TABLE vehiculo DROP configuracion_id');
    }
}
