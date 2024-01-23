<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240123175247 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE celda ADD responsable VARCHAR(200) DEFAULT NULL');
        $this->addSql('ALTER TABLE celda ADD celular VARCHAR(20) DEFAULT NULL');
        $this->addSql('ALTER TABLE celda ADD correo VARCHAR(150) DEFAULT NULL');
        $this->addSql('ALTER TABLE celda ADD llave VARCHAR(200) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE celda DROP responsable');
        $this->addSql('ALTER TABLE celda DROP celular');
        $this->addSql('ALTER TABLE celda DROP correo');
        $this->addSql('ALTER TABLE celda DROP llave');
    }
}
