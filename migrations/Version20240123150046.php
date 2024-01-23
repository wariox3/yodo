<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240123150046 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE usuario ADD celda_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE usuario ADD panal_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE usuario ADD CONSTRAINT FK_2265B05DEBD6899B FOREIGN KEY (celda_id) REFERENCES celda (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE usuario ADD CONSTRAINT FK_2265B05D9AEF6DE6 FOREIGN KEY (panal_id) REFERENCES panal (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_2265B05DEBD6899B ON usuario (celda_id)');
        $this->addSql('CREATE INDEX IDX_2265B05D9AEF6DE6 ON usuario (panal_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE usuario DROP CONSTRAINT FK_2265B05DEBD6899B');
        $this->addSql('ALTER TABLE usuario DROP CONSTRAINT FK_2265B05D9AEF6DE6');
        $this->addSql('DROP INDEX IDX_2265B05DEBD6899B');
        $this->addSql('DROP INDEX IDX_2265B05D9AEF6DE6');
        $this->addSql('ALTER TABLE usuario DROP celda_id');
        $this->addSql('ALTER TABLE usuario DROP panal_id');
    }
}
