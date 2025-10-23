<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251023090924 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Remove candidate_id from feedbacks (accessible via session) and set default ROLE_USER for users';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE feedbacks DROP CONSTRAINT fk_7e6c3f8991bd8781');
        $this->addSql('DROP INDEX uniq_7e6c3f8991bd8781');
        $this->addSql('ALTER TABLE feedbacks DROP candidate_id');
        $this->addSql('ALTER TABLE users ALTER password SET NOT NULL');
        $this->addSql('ALTER TABLE users ALTER roles SET DEFAULT \'["ROLE_USER"]\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE users ALTER password DROP NOT NULL');
        $this->addSql('ALTER TABLE users ALTER roles SET DEFAULT \'[]\'');
        $this->addSql('ALTER TABLE feedbacks ADD candidate_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE feedbacks ADD CONSTRAINT fk_7e6c3f8991bd8781 FOREIGN KEY (candidate_id) REFERENCES users (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE UNIQUE INDEX uniq_7e6c3f8991bd8781 ON feedbacks (candidate_id)');
    }
}
