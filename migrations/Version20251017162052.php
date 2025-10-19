<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251017162052 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Modifying Tests & Sessions entities. Relation ManyToOne applied between Sessions & Tests | Relation OneToMany between Tests & Sessions';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX uniq_9a609d131e5d0459');
        $this->addSql('CREATE INDEX IDX_9A609D131E5D0459 ON sessions (test_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP INDEX IDX_9A609D131E5D0459');
        $this->addSql('CREATE UNIQUE INDEX uniq_9a609d131e5d0459 ON sessions (test_id)');
    }
}
