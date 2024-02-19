<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240219174425 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE despacho_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE guia_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE operador_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE despacho (id INT NOT NULL, operador_id INT NOT NULL, fecha_creacion TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, fecha_salida TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, codigo INT NOT NULL, numero INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_254BF5B35B939A38 ON despacho (operador_id)');
        $this->addSql('CREATE TABLE guia (id INT NOT NULL, despacho_id INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_5B053B3D299C08BC ON guia (despacho_id)');
        $this->addSql('CREATE TABLE operador (id INT NOT NULL, nombre VARCHAR(200) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE despacho ADD CONSTRAINT FK_254BF5B35B939A38 FOREIGN KEY (operador_id) REFERENCES operador (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE guia ADD CONSTRAINT FK_5B053B3D299C08BC FOREIGN KEY (despacho_id) REFERENCES despacho (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE despacho_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE guia_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE operador_id_seq CASCADE');
        $this->addSql('ALTER TABLE despacho DROP CONSTRAINT FK_254BF5B35B939A38');
        $this->addSql('ALTER TABLE guia DROP CONSTRAINT FK_5B053B3D299C08BC');
        $this->addSql('DROP TABLE despacho');
        $this->addSql('DROP TABLE guia');
        $this->addSql('DROP TABLE operador');
    }
}
