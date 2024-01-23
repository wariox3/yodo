<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240123174810 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE celda_usuario_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE celda_usuario (id INT NOT NULL, celda_id INT NOT NULL, usuario_id INT NOT NULL, llave VARCHAR(200) NOT NULL, validado BOOLEAN DEFAULT false NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_F6695051EBD6899B ON celda_usuario (celda_id)');
        $this->addSql('CREATE INDEX IDX_F6695051DB38439E ON celda_usuario (usuario_id)');
        $this->addSql('ALTER TABLE celda_usuario ADD CONSTRAINT FK_F6695051EBD6899B FOREIGN KEY (celda_id) REFERENCES celda (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE celda_usuario ADD CONSTRAINT FK_F6695051DB38439E FOREIGN KEY (usuario_id) REFERENCES usuario (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE celda_usuario_id_seq CASCADE');
        $this->addSql('ALTER TABLE celda_usuario DROP CONSTRAINT FK_F6695051EBD6899B');
        $this->addSql('ALTER TABLE celda_usuario DROP CONSTRAINT FK_F6695051DB38439E');
        $this->addSql('DROP TABLE celda_usuario');
    }
}
