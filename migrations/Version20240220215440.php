<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240220215440 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE operador ADD punto_servicio VARCHAR(200) DEFAULT NULL');
        $this->addSql('ALTER TABLE operador ADD punto_servicio_usuario VARCHAR(50) DEFAULT NULL');
        $this->addSql('ALTER TABLE operador ADD punto_servicio_clave VARCHAR(50) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE operador DROP punto_servicio');
        $this->addSql('ALTER TABLE operador DROP punto_servicio_usuario');
        $this->addSql('ALTER TABLE operador DROP punto_servicio_clave');
    }
}
