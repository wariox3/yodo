<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240221212734 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE guia ADD entrega_requiere_foto BOOLEAN DEFAULT false NOT NULL');
        $this->addSql('ALTER TABLE guia ADD entrega_requiere_firma BOOLEAN DEFAULT false NOT NULL');
        $this->addSql('ALTER TABLE guia ADD entrega_requiere_datos BOOLEAN DEFAULT false NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE guia DROP entrega_requiere_foto');
        $this->addSql('ALTER TABLE guia DROP entrega_requiere_firma');
        $this->addSql('ALTER TABLE guia DROP entrega_requiere_datos');
    }
}
