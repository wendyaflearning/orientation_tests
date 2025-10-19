<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251015100029 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Modifiying Answers entity to delete session_id property, Creating SessionsAnswers entites and deleting method dimension id in Questions entity';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE answers (id SERIAL NOT NULL, session_id INT DEFAULT NULL, question_id INT DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_50D0C606613FECDF ON answers (session_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_50D0C6061E27F6BF ON answers (question_id)');
        $this->addSql('CREATE TABLE feedbacks (id SERIAL NOT NULL, candidate_id INT DEFAULT NULL, session_id INT DEFAULT NULL, content TEXT NOT NULL, structured_data JSON NOT NULL, llm_model VARCHAR(255) NOT NULL, tokens_consumed INT DEFAULT NULL, generated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_7E6C3F8991BD8781 ON feedbacks (candidate_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_7E6C3F89613FECDF ON feedbacks (session_id)');
        $this->addSql('COMMENT ON COLUMN feedbacks.generated_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE TABLE method (id SERIAL NOT NULL, name VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE method_dimension (id SERIAL NOT NULL, method_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, code VARCHAR(20) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_D47C54BA19883967 ON method_dimension (method_id)');
        $this->addSql('CREATE TABLE questions (id SERIAL NOT NULL, method_dimension_id INT DEFAULT NULL, test_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, order_index SMALLINT NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_8ADC54D529EC1B65 ON questions (method_dimension_id)');
        $this->addSql('CREATE INDEX IDX_8ADC54D51E5D0459 ON questions (test_id)');
        $this->addSql('CREATE TABLE scores (id SERIAL NOT NULL, question_id INT NOT NULL, session_id INT NOT NULL, value SMALLINT NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_750375E1E27F6BF ON scores (question_id)');
        $this->addSql('CREATE INDEX IDX_750375E613FECDF ON scores (session_id)');
        $this->addSql('CREATE TABLE sessions (id SERIAL NOT NULL, test_id INT DEFAULT NULL, candidate_id INT DEFAULT NULL, status VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_9A609D131E5D0459 ON sessions (test_id)');
        $this->addSql('CREATE INDEX IDX_9A609D1391BD8781 ON sessions (candidate_id)');
        $this->addSql('CREATE TABLE tests (id SERIAL NOT NULL, method_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, description TEXT DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1260FC5E19883967 ON tests (method_id)');
        $this->addSql('CREATE TABLE users (id SERIAL NOT NULL, name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, age INT NOT NULL, status VARCHAR(255) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP NOT NULL, updated_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT CURRENT_TIMESTAMP NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE messenger_messages (id BIGSERIAL NOT NULL, body TEXT NOT NULL, headers TEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, available_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, delivered_at TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_75EA56E0FB7336F0 ON messenger_messages (queue_name)');
        $this->addSql('CREATE INDEX IDX_75EA56E0E3BD61CE ON messenger_messages (available_at)');
        $this->addSql('CREATE INDEX IDX_75EA56E016BA31DB ON messenger_messages (delivered_at)');
        $this->addSql('COMMENT ON COLUMN messenger_messages.created_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN messenger_messages.available_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('COMMENT ON COLUMN messenger_messages.delivered_at IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('CREATE OR REPLACE FUNCTION notify_messenger_messages() RETURNS TRIGGER AS $$
            BEGIN
                PERFORM pg_notify(\'messenger_messages\', NEW.queue_name::text);
                RETURN NEW;
            END;
        $$ LANGUAGE plpgsql;');
        $this->addSql('DROP TRIGGER IF EXISTS notify_trigger ON messenger_messages;');
        $this->addSql('CREATE TRIGGER notify_trigger AFTER INSERT OR UPDATE ON messenger_messages FOR EACH ROW EXECUTE PROCEDURE notify_messenger_messages();');
        $this->addSql('ALTER TABLE answers ADD CONSTRAINT FK_50D0C606613FECDF FOREIGN KEY (session_id) REFERENCES sessions (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE answers ADD CONSTRAINT FK_50D0C6061E27F6BF FOREIGN KEY (question_id) REFERENCES questions (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE feedbacks ADD CONSTRAINT FK_7E6C3F8991BD8781 FOREIGN KEY (candidate_id) REFERENCES users (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE feedbacks ADD CONSTRAINT FK_7E6C3F89613FECDF FOREIGN KEY (session_id) REFERENCES sessions (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE method_dimension ADD CONSTRAINT FK_D47C54BA19883967 FOREIGN KEY (method_id) REFERENCES method (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE questions ADD CONSTRAINT FK_8ADC54D529EC1B65 FOREIGN KEY (method_dimension_id) REFERENCES method_dimension (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE questions ADD CONSTRAINT FK_8ADC54D51E5D0459 FOREIGN KEY (test_id) REFERENCES tests (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE scores ADD CONSTRAINT FK_750375E1E27F6BF FOREIGN KEY (question_id) REFERENCES questions (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE scores ADD CONSTRAINT FK_750375E613FECDF FOREIGN KEY (session_id) REFERENCES sessions (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE sessions ADD CONSTRAINT FK_9A609D131E5D0459 FOREIGN KEY (test_id) REFERENCES tests (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE sessions ADD CONSTRAINT FK_9A609D1391BD8781 FOREIGN KEY (candidate_id) REFERENCES users (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE tests ADD CONSTRAINT FK_1260FC5E19883967 FOREIGN KEY (method_id) REFERENCES method (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE answers DROP CONSTRAINT FK_50D0C606613FECDF');
        $this->addSql('ALTER TABLE answers DROP CONSTRAINT FK_50D0C6061E27F6BF');
        $this->addSql('ALTER TABLE feedbacks DROP CONSTRAINT FK_7E6C3F8991BD8781');
        $this->addSql('ALTER TABLE feedbacks DROP CONSTRAINT FK_7E6C3F89613FECDF');
        $this->addSql('ALTER TABLE method_dimension DROP CONSTRAINT FK_D47C54BA19883967');
        $this->addSql('ALTER TABLE questions DROP CONSTRAINT FK_8ADC54D529EC1B65');
        $this->addSql('ALTER TABLE questions DROP CONSTRAINT FK_8ADC54D51E5D0459');
        $this->addSql('ALTER TABLE scores DROP CONSTRAINT FK_750375E1E27F6BF');
        $this->addSql('ALTER TABLE scores DROP CONSTRAINT FK_750375E613FECDF');
        $this->addSql('ALTER TABLE sessions DROP CONSTRAINT FK_9A609D131E5D0459');
        $this->addSql('ALTER TABLE sessions DROP CONSTRAINT FK_9A609D1391BD8781');
        $this->addSql('ALTER TABLE tests DROP CONSTRAINT FK_1260FC5E19883967');
        $this->addSql('DROP TABLE answers');
        $this->addSql('DROP TABLE feedbacks');
        $this->addSql('DROP TABLE method');
        $this->addSql('DROP TABLE method_dimension');
        $this->addSql('DROP TABLE questions');
        $this->addSql('DROP TABLE scores');
        $this->addSql('DROP TABLE sessions');
        $this->addSql('DROP TABLE tests');
        $this->addSql('DROP TABLE users');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
