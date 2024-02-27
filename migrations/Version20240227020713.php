<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240227020713 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE carroceria (id INT NOT NULL, nombre VARCHAR(100) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE color (id INT NOT NULL, nombre VARCHAR(100) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE combustible (id INT NOT NULL, nombre VARCHAR(50) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE linea (id INT NOT NULL, marca_id INT NOT NULL, codigo INT NOT NULL, nombre VARCHAR(100) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_BCB8FDDE81EF0041 ON linea (marca_id)');
        $this->addSql('CREATE TABLE marca (id INT NOT NULL, nombre VARCHAR(100) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE linea ADD CONSTRAINT FK_BCB8FDDE81EF0041 FOREIGN KEY (marca_id) REFERENCES marca (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE vehiculo ADD usuario_id INT NOT NULL');
        $this->addSql('ALTER TABLE vehiculo ADD color_id INT NOT NULL');
        $this->addSql('ALTER TABLE vehiculo ADD marca_id INT NOT NULL');
        $this->addSql('ALTER TABLE vehiculo ADD linea_id INT NOT NULL');
        $this->addSql('ALTER TABLE vehiculo ADD carroceria_id INT NOT NULL');
        $this->addSql('ALTER TABLE vehiculo ADD combustible_id INT NOT NULL');
        $this->addSql('ALTER TABLE vehiculo ADD numero_ejes INT DEFAULT 0 NOT NULL');
        $this->addSql('ALTER TABLE vehiculo ADD capacidad INT DEFAULT 0 NOT NULL');
        $this->addSql('ALTER TABLE vehiculo ADD peso_vacio INT DEFAULT 0 NOT NULL');
        $this->addSql('ALTER TABLE vehiculo ADD numero_poliza VARCHAR(30) NOT NULL');
        $this->addSql('ALTER TABLE vehiculo ADD vigencia_poliza DATE NOT NULL');
        $this->addSql('ALTER TABLE vehiculo ADD vigencia_revision_tecnica DATE NOT NULL');
        $this->addSql('ALTER TABLE vehiculo DROP modelo');
        $this->addSql('ALTER TABLE vehiculo ADD CONSTRAINT FK_C9FA1603DB38439E FOREIGN KEY (usuario_id) REFERENCES usuario (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE vehiculo ADD CONSTRAINT FK_C9FA16037ADA1FB5 FOREIGN KEY (color_id) REFERENCES color (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE vehiculo ADD CONSTRAINT FK_C9FA160381EF0041 FOREIGN KEY (marca_id) REFERENCES marca (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE vehiculo ADD CONSTRAINT FK_C9FA160385FE79F8 FOREIGN KEY (linea_id) REFERENCES linea (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE vehiculo ADD CONSTRAINT FK_C9FA1603972AD13F FOREIGN KEY (carroceria_id) REFERENCES carroceria (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE vehiculo ADD CONSTRAINT FK_C9FA1603D5BD96DF FOREIGN KEY (combustible_id) REFERENCES combustible (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_C9FA1603DB38439E ON vehiculo (usuario_id)');
        $this->addSql('CREATE INDEX IDX_C9FA16037ADA1FB5 ON vehiculo (color_id)');
        $this->addSql('CREATE INDEX IDX_C9FA160381EF0041 ON vehiculo (marca_id)');
        $this->addSql('CREATE INDEX IDX_C9FA160385FE79F8 ON vehiculo (linea_id)');
        $this->addSql('CREATE INDEX IDX_C9FA1603972AD13F ON vehiculo (carroceria_id)');
        $this->addSql('CREATE INDEX IDX_C9FA1603D5BD96DF ON vehiculo (combustible_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE vehiculo DROP CONSTRAINT FK_C9FA1603972AD13F');
        $this->addSql('ALTER TABLE vehiculo DROP CONSTRAINT FK_C9FA16037ADA1FB5');
        $this->addSql('ALTER TABLE vehiculo DROP CONSTRAINT FK_C9FA1603D5BD96DF');
        $this->addSql('ALTER TABLE vehiculo DROP CONSTRAINT FK_C9FA160385FE79F8');
        $this->addSql('ALTER TABLE vehiculo DROP CONSTRAINT FK_C9FA160381EF0041');
        $this->addSql('ALTER TABLE linea DROP CONSTRAINT FK_BCB8FDDE81EF0041');
        $this->addSql('DROP TABLE carroceria');
        $this->addSql('DROP TABLE color');
        $this->addSql('DROP TABLE combustible');
        $this->addSql('DROP TABLE linea');
        $this->addSql('DROP TABLE marca');
        $this->addSql('ALTER TABLE vehiculo DROP CONSTRAINT FK_C9FA1603DB38439E');
        $this->addSql('DROP INDEX IDX_C9FA1603DB38439E');
        $this->addSql('DROP INDEX IDX_C9FA16037ADA1FB5');
        $this->addSql('DROP INDEX IDX_C9FA160381EF0041');
        $this->addSql('DROP INDEX IDX_C9FA160385FE79F8');
        $this->addSql('DROP INDEX IDX_C9FA1603972AD13F');
        $this->addSql('DROP INDEX IDX_C9FA1603D5BD96DF');
        $this->addSql('ALTER TABLE vehiculo ADD modelo VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE vehiculo DROP usuario_id');
        $this->addSql('ALTER TABLE vehiculo DROP color_id');
        $this->addSql('ALTER TABLE vehiculo DROP marca_id');
        $this->addSql('ALTER TABLE vehiculo DROP linea_id');
        $this->addSql('ALTER TABLE vehiculo DROP carroceria_id');
        $this->addSql('ALTER TABLE vehiculo DROP combustible_id');
        $this->addSql('ALTER TABLE vehiculo DROP numero_ejes');
        $this->addSql('ALTER TABLE vehiculo DROP capacidad');
        $this->addSql('ALTER TABLE vehiculo DROP peso_vacio');
        $this->addSql('ALTER TABLE vehiculo DROP numero_poliza');
        $this->addSql('ALTER TABLE vehiculo DROP vigencia_poliza');
        $this->addSql('ALTER TABLE vehiculo DROP vigencia_revision_tecnica');
    }
}
