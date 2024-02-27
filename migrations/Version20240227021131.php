<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240227021131 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE vehiculo DROP CONSTRAINT fk_c9fa16037ada1fb5');
        $this->addSql('DROP TABLE color');
        $this->addSql('DROP INDEX idx_c9fa16037ada1fb5');
        $this->addSql('ALTER TABLE vehiculo DROP color_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('CREATE TABLE color (id INT NOT NULL, nombre VARCHAR(100) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE vehiculo ADD color_id INT NOT NULL');
        $this->addSql('ALTER TABLE vehiculo ADD CONSTRAINT fk_c9fa16037ada1fb5 FOREIGN KEY (color_id) REFERENCES color (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_c9fa16037ada1fb5 ON vehiculo (color_id)');
    }
}
