<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240221180711 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE guia ADD codigo INT NOT NULL');
        $this->addSql('ALTER TABLE guia ADD fecha TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL');
        $this->addSql('ALTER TABLE guia ADD documento_cliente VARCHAR(80) DEFAULT NULL');
        $this->addSql('ALTER TABLE guia ADD unidades DOUBLE PRECISION DEFAULT \'0\' NOT NULL');
        $this->addSql('ALTER TABLE guia ADD peso_real DOUBLE PRECISION DEFAULT \'0\' NOT NULL');
        $this->addSql('ALTER TABLE guia ADD peso_volumen DOUBLE PRECISION DEFAULT \'0\' NOT NULL');
        $this->addSql('ALTER TABLE guia ADD vr_cobro_entrega DOUBLE PRECISION DEFAULT \'0\' NOT NULL');
        $this->addSql('ALTER TABLE guia ADD estado_novedad BOOLEAN DEFAULT false NOT NULL');
        $this->addSql('ALTER TABLE guia ADD remitente VARCHAR(150) DEFAULT NULL');
        $this->addSql('ALTER TABLE guia ADD destinatario VARCHAR(150) DEFAULT NULL');
        $this->addSql('ALTER TABLE guia ADD destinatario_telefono VARCHAR(80) DEFAULT NULL');
        $this->addSql('ALTER TABLE guia ADD destinatario_direccion VARCHAR(150) DEFAULT NULL');
        $this->addSql('ALTER TABLE guia ADD ciudad_destino_nombre VARCHAR(100) DEFAULT NULL');
        $this->addSql('ALTER TABLE guia ADD departamento_destino_nombre VARCHAR(100) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE guia DROP codigo');
        $this->addSql('ALTER TABLE guia DROP fecha');
        $this->addSql('ALTER TABLE guia DROP documento_cliente');
        $this->addSql('ALTER TABLE guia DROP unidades');
        $this->addSql('ALTER TABLE guia DROP peso_real');
        $this->addSql('ALTER TABLE guia DROP peso_volumen');
        $this->addSql('ALTER TABLE guia DROP vr_cobro_entrega');
        $this->addSql('ALTER TABLE guia DROP estado_novedad');
        $this->addSql('ALTER TABLE guia DROP remitente');
        $this->addSql('ALTER TABLE guia DROP destinatario');
        $this->addSql('ALTER TABLE guia DROP destinatario_telefono');
        $this->addSql('ALTER TABLE guia DROP destinatario_direccion');
        $this->addSql('ALTER TABLE guia DROP ciudad_destino_nombre');
        $this->addSql('ALTER TABLE guia DROP departamento_destino_nombre');
    }
}
