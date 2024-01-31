<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240131180830 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE reserva_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE reserva_detalle_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE reserva (id INT NOT NULL, panal_id INT DEFAULT NULL, nombre VARCHAR(200) DEFAULT NULL, descripcion TEXT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_188D2E3B9AEF6DE6 ON reserva (panal_id)');
        $this->addSql('CREATE TABLE reserva_detalle (id INT NOT NULL, reserva_id INT DEFAULT NULL, celda_id INT DEFAULT NULL, fecha TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, comentario TEXT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_41EA4BE2D67139E8 ON reserva_detalle (reserva_id)');
        $this->addSql('CREATE INDEX IDX_41EA4BE2EBD6899B ON reserva_detalle (celda_id)');
        $this->addSql('ALTER TABLE reserva ADD CONSTRAINT FK_188D2E3B9AEF6DE6 FOREIGN KEY (panal_id) REFERENCES panal (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE reserva_detalle ADD CONSTRAINT FK_41EA4BE2D67139E8 FOREIGN KEY (reserva_id) REFERENCES reserva (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE reserva_detalle ADD CONSTRAINT FK_41EA4BE2EBD6899B FOREIGN KEY (celda_id) REFERENCES celda (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE reserva_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE reserva_detalle_id_seq CASCADE');
        $this->addSql('ALTER TABLE reserva DROP CONSTRAINT FK_188D2E3B9AEF6DE6');
        $this->addSql('ALTER TABLE reserva_detalle DROP CONSTRAINT FK_41EA4BE2D67139E8');
        $this->addSql('ALTER TABLE reserva_detalle DROP CONSTRAINT FK_41EA4BE2EBD6899B');
        $this->addSql('DROP TABLE reserva');
        $this->addSql('DROP TABLE reserva_detalle');
    }
}
