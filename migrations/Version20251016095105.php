<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251016095105 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Adding method_dimension_value and content in Answers entity';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE answers ADD method_dimension_value SMALLINT DEFAULT NULL');
        $this->addSql("ALTER TABLE answers ADD content TEXT DEFAULT NULL");
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE answers DROP content');
        $this->addSql('ALTER TABLE answers DROP method_dimension_value');
    }
}
