<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240131235003 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE solicitud ADD usuario_id INT NOT NULL');
        $this->addSql('ALTER TABLE solicitud ADD CONSTRAINT FK_96D27CC0DB38439E FOREIGN KEY (usuario_id) REFERENCES usuario (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_96D27CC0DB38439E ON solicitud (usuario_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE solicitud DROP CONSTRAINT FK_96D27CC0DB38439E');
        $this->addSql('DROP INDEX IDX_96D27CC0DB38439E');
        $this->addSql('ALTER TABLE solicitud DROP usuario_id');
    }
}
