<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240301215839 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE cambio_clave_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE cambio_clave (id INT NOT NULL, usuario_id INT NOT NULL, fecha TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, codigo INT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_E8785A5DB38439E ON cambio_clave (usuario_id)');
        $this->addSql('ALTER TABLE cambio_clave ADD CONSTRAINT FK_E8785A5DB38439E FOREIGN KEY (usuario_id) REFERENCES usuario (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE cambio_clave_id_seq CASCADE');
        $this->addSql('ALTER TABLE cambio_clave DROP CONSTRAINT FK_E8785A5DB38439E');
        $this->addSql('DROP TABLE cambio_clave');
    }
}
