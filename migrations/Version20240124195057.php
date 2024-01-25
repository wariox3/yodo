<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240124195057 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE entrega_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE visita_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE entrega (id INT NOT NULL, celda_id INT NOT NULL, entrega_tipo_id INT NOT NULL, fecha_ingreso TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, fecha_entrega TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, descripcion VARCHAR(200) NOT NULL, url_imagen_ingreso VARCHAR(250) NOT NULL, estado_entregado BOOLEAN DEFAULT false NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_E56D596BB2FDCBB3 ON entrega (entrega_tipo_id)');
        $this->addSql('CREATE INDEX IDX_E56D596BEBD6899B ON entrega (celda_id)');
        $this->addSql('CREATE TABLE entrega_tipo (id INT NOT NULL, nombre VARCHAR(80) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE visita (id INT NOT NULL, celda_id INT NOT NULL, panal_id INT NOT NULL, usuario_autoriza_id INT DEFAULT NULL, fecha TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, numero_identificacion VARCHAR(30) DEFAULT NULL, nombre VARCHAR(150) DEFAULT NULL, placa VARCHAR(10) DEFAULT NULL, codigo_ingreso VARCHAR(10) DEFAULT NULL, url_imagen_ingreso VARCHAR(250) NOT NULL, estado_autorizado BOOLEAN DEFAULT false NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_B7F148A2EBD6899B ON visita (celda_id)');
        $this->addSql('CREATE INDEX IDX_B7F148A29AEF6DE6 ON visita (panal_id)');
        $this->addSql('CREATE INDEX IDX_B7F148A28BE68F32 ON visita (usuario_autoriza_id)');
        $this->addSql('ALTER TABLE entrega ADD CONSTRAINT FK_E56D596BB2FDCBB3 FOREIGN KEY (entrega_tipo_id) REFERENCES entrega_tipo (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE entrega ADD CONSTRAINT FK_E56D596BEBD6899B FOREIGN KEY (celda_id) REFERENCES celda (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE visita ADD CONSTRAINT FK_B7F148A2EBD6899B FOREIGN KEY (celda_id) REFERENCES celda (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE visita ADD CONSTRAINT FK_B7F148A29AEF6DE6 FOREIGN KEY (panal_id) REFERENCES panal (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE visita ADD CONSTRAINT FK_B7F148A28BE68F32 FOREIGN KEY (usuario_autoriza_id) REFERENCES usuario (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE entrega_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE visita_id_seq CASCADE');
        $this->addSql('ALTER TABLE entrega DROP CONSTRAINT FK_E56D596BB2FDCBB3');
        $this->addSql('ALTER TABLE entrega DROP CONSTRAINT FK_E56D596BEBD6899B');
        $this->addSql('ALTER TABLE visita DROP CONSTRAINT FK_B7F148A2EBD6899B');
        $this->addSql('ALTER TABLE visita DROP CONSTRAINT FK_B7F148A29AEF6DE6');
        $this->addSql('ALTER TABLE visita DROP CONSTRAINT FK_B7F148A28BE68F32');
        $this->addSql('DROP TABLE entrega');
        $this->addSql('DROP TABLE entrega_tipo');
        $this->addSql('DROP TABLE visita');
    }
}
