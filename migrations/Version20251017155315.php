<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251017155315 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Modifying relation between Questions & Answers entity to OneToMany';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX uniq_50d0c6061e27f6bf');
        $this->addSql('CREATE INDEX IDX_50D0C6061E27F6BF ON answers (question_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP INDEX IDX_50D0C6061E27F6BF');
        $this->addSql('CREATE UNIQUE INDEX uniq_50d0c6061e27f6bf ON answers (question_id)');
    }
}
