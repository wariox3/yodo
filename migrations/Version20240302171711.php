<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240302171711 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ciudad ADD codigo_dane VARCHAR(10) NOT NULL');
        $this->addSql('ALTER TABLE ciudad ADD codigo_postal VARCHAR(10) NOT NULL');
        $this->addSql('ALTER TABLE ciudad ALTER estado_id SET NOT NULL');
        $this->addSql('ALTER TABLE ciudad ALTER nombre TYPE VARCHAR(100)');
        $this->addSql('ALTER TABLE estado ADD codigo_dane VARCHAR(10) NOT NULL');
        $this->addSql('ALTER TABLE estado ALTER pais_id SET NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE estado DROP codigo_dane');
        $this->addSql('ALTER TABLE estado ALTER pais_id DROP NOT NULL');
        $this->addSql('ALTER TABLE ciudad DROP codigo_dane');
        $this->addSql('ALTER TABLE ciudad DROP codigo_postal');
        $this->addSql('ALTER TABLE ciudad ALTER estado_id DROP NOT NULL');
        $this->addSql('ALTER TABLE ciudad ALTER nombre TYPE VARCHAR(80)');
    }
}
