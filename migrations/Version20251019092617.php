<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251019092617 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Creating unique index on method_dimension_id in Answers entity';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX uniq_50d0c60629ec1b65');
        $this->addSql('CREATE INDEX IDX_50D0C60629EC1B65 ON answers (method_dimension_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP INDEX IDX_50D0C60629EC1B65');
        $this->addSql('CREATE UNIQUE INDEX uniq_50d0c60629ec1b65 ON answers (method_dimension_id)');
    }
}
