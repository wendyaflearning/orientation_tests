<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251016094157 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE sessions_answers (id SERIAL NOT NULL, answer_id INT DEFAULT NULL, session_id INT DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_CBF136A4AA334807 ON sessions_answers (answer_id)');
        $this->addSql('CREATE INDEX IDX_CBF136A4613FECDF ON sessions_answers (session_id)');
        $this->addSql('ALTER TABLE sessions_answers ADD CONSTRAINT FK_CBF136A4AA334807 FOREIGN KEY (answer_id) REFERENCES answers (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE sessions_answers ADD CONSTRAINT FK_CBF136A4613FECDF FOREIGN KEY (session_id) REFERENCES sessions (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE answers DROP CONSTRAINT fk_50d0c606613fecdf');
        $this->addSql('DROP INDEX idx_50d0c606613fecdf');
        $this->addSql('ALTER TABLE answers RENAME COLUMN session_id TO method_dimension_id');
        $this->addSql('ALTER TABLE answers ADD CONSTRAINT FK_50D0C60629EC1B65 FOREIGN KEY (method_dimension_id) REFERENCES method_dimension (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_50D0C60629EC1B65 ON answers (method_dimension_id)');
        $this->addSql('ALTER TABLE questions DROP CONSTRAINT fk_8adc54d529ec1b65');
        $this->addSql('DROP INDEX idx_8adc54d529ec1b65');
        $this->addSql('ALTER TABLE questions DROP method_dimension_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE sessions_answers DROP CONSTRAINT FK_CBF136A4AA334807');
        $this->addSql('ALTER TABLE sessions_answers DROP CONSTRAINT FK_CBF136A4613FECDF');
        $this->addSql('DROP TABLE sessions_answers');
        $this->addSql('ALTER TABLE answers DROP CONSTRAINT FK_50D0C60629EC1B65');
        $this->addSql('DROP INDEX UNIQ_50D0C60629EC1B65');
        $this->addSql('ALTER TABLE answers RENAME COLUMN method_dimension_id TO session_id');
        $this->addSql('ALTER TABLE answers ADD CONSTRAINT fk_50d0c606613fecdf FOREIGN KEY (session_id) REFERENCES sessions (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_50d0c606613fecdf ON answers (session_id)');
        $this->addSql('ALTER TABLE questions ADD method_dimension_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE questions ADD CONSTRAINT fk_8adc54d529ec1b65 FOREIGN KEY (method_dimension_id) REFERENCES method_dimension (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX idx_8adc54d529ec1b65 ON questions (method_dimension_id)');
    }
}
