<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240123161225 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE ciudad (id INT NOT NULL, estado_id INT DEFAULT NULL, nombre VARCHAR(80) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_8E86059E9F5A440B ON ciudad (estado_id)');
        $this->addSql('CREATE TABLE estado (id INT NOT NULL, pais_id INT DEFAULT NULL, nombre VARCHAR(80) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_265DE1E3C604D5C6 ON estado (pais_id)');
        $this->addSql('CREATE TABLE pais (id INT NOT NULL, nombre VARCHAR(80) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('ALTER TABLE ciudad ADD CONSTRAINT FK_8E86059E9F5A440B FOREIGN KEY (estado_id) REFERENCES estado (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE estado ADD CONSTRAINT FK_265DE1E3C604D5C6 FOREIGN KEY (pais_id) REFERENCES pais (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE panal ADD ciudad_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE panal ADD CONSTRAINT FK_C6C1160BE8608214 FOREIGN KEY (ciudad_id) REFERENCES ciudad (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_C6C1160BE8608214 ON panal (ciudad_id)');
        $this->addSql('ALTER TABLE usuario ADD ciudad_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE usuario ADD CONSTRAINT FK_2265B05DE8608214 FOREIGN KEY (ciudad_id) REFERENCES ciudad (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_2265B05DE8608214 ON usuario (ciudad_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE panal DROP CONSTRAINT FK_C6C1160BE8608214');
        $this->addSql('ALTER TABLE usuario DROP CONSTRAINT FK_2265B05DE8608214');
        $this->addSql('ALTER TABLE ciudad DROP CONSTRAINT FK_8E86059E9F5A440B');
        $this->addSql('ALTER TABLE estado DROP CONSTRAINT FK_265DE1E3C604D5C6');
        $this->addSql('DROP TABLE ciudad');
        $this->addSql('DROP TABLE estado');
        $this->addSql('DROP TABLE pais');
        $this->addSql('DROP INDEX IDX_C6C1160BE8608214');
        $this->addSql('ALTER TABLE panal DROP ciudad_id');
        $this->addSql('DROP INDEX IDX_2265B05DE8608214');
        $this->addSql('ALTER TABLE usuario DROP ciudad_id');
    }
}
