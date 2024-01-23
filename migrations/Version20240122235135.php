<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240122235135 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE usuario ADD nombre_corto VARCHAR(180) DEFAULT NULL');
        $this->addSql('ALTER TABLE usuario ADD celular VARCHAR(20) DEFAULT NULL');
        $this->addSql('ALTER TABLE usuario ADD imagen_perfil VARCHAR(250) DEFAULT NULL');
        $this->addSql('ALTER TABLE usuario ADD token_firebase VARCHAR(500) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE usuario DROP nombre_corto');
        $this->addSql('ALTER TABLE usuario DROP celular');
        $this->addSql('ALTER TABLE usuario DROP imagen_perfil');
        $this->addSql('ALTER TABLE usuario DROP token_firebase');
    }
}
