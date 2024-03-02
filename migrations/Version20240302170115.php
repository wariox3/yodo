<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240302170115 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE solicitud ADD ciudad_origen_id INT NOT NULL');
        $this->addSql('ALTER TABLE solicitud ADD ciudad_destino_id INT NOT NULL');
        $this->addSql('ALTER TABLE solicitud ADD carroceria_id INT NOT NULL');
        $this->addSql('ALTER TABLE solicitud ADD precio DOUBLE PRECISION DEFAULT \'0\' NOT NULL');
        $this->addSql('ALTER TABLE solicitud ADD peso DOUBLE PRECISION DEFAULT \'0\' NOT NULL');
        $this->addSql('ALTER TABLE solicitud ADD volumen DOUBLE PRECISION DEFAULT \'0\' NOT NULL');
        $this->addSql('ALTER TABLE solicitud ADD entregas INT DEFAULT 0 NOT NULL');
        $this->addSql('ALTER TABLE solicitud ADD CONSTRAINT FK_96D27CC0972AD13F FOREIGN KEY (carroceria_id) REFERENCES carroceria (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE solicitud ADD CONSTRAINT FK_96D27CC0646DF37 FOREIGN KEY (ciudad_origen_id) REFERENCES ciudad (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE solicitud ADD CONSTRAINT FK_96D27CC0B9CB0956 FOREIGN KEY (ciudad_destino_id) REFERENCES ciudad (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_96D27CC0972AD13F ON solicitud (carroceria_id)');
        $this->addSql('CREATE INDEX IDX_96D27CC0646DF37 ON solicitud (ciudad_origen_id)');
        $this->addSql('CREATE INDEX IDX_96D27CC0B9CB0956 ON solicitud (ciudad_destino_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE solicitud DROP CONSTRAINT FK_96D27CC0972AD13F');
        $this->addSql('ALTER TABLE solicitud DROP CONSTRAINT FK_96D27CC0646DF37');
        $this->addSql('ALTER TABLE solicitud DROP CONSTRAINT FK_96D27CC0B9CB0956');
        $this->addSql('DROP INDEX IDX_96D27CC0972AD13F');
        $this->addSql('DROP INDEX IDX_96D27CC0646DF37');
        $this->addSql('DROP INDEX IDX_96D27CC0B9CB0956');
        $this->addSql('ALTER TABLE solicitud DROP ciudad_origen_id');
        $this->addSql('ALTER TABLE solicitud DROP ciudad_destino_id');
        $this->addSql('ALTER TABLE solicitud DROP carroceria_id');
        $this->addSql('ALTER TABLE solicitud DROP precio');
        $this->addSql('ALTER TABLE solicitud DROP peso');
        $this->addSql('ALTER TABLE solicitud DROP volumen');
        $this->addSql('ALTER TABLE solicitud DROP entregas');
    }
}
