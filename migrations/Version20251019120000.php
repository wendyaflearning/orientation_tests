<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Migration pour remplacer la relation Scores->Questions par Scores->MethodDimension
 */
final class Version20251019120000 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Replace Scores->Questions relation with Scores->MethodDimension relation';
    }

    public function up(Schema $schema): void
    {
        // Supprimer la contrainte de foreign key sur question_id
        $this->addSql('ALTER TABLE scores DROP CONSTRAINT IF EXISTS FK_1EF03468FAF8F9EF');
        
        // Supprimer la colonne question_id
        $this->addSql('ALTER TABLE scores DROP COLUMN question_id');
        
        // Ajouter la colonne method_dimension_id
        $this->addSql('ALTER TABLE scores ADD method_dimension_id INT NOT NULL');
        
        // Créer la contrainte de foreign key vers method_dimension
        $this->addSql('ALTER TABLE scores ADD CONSTRAINT FK_1EF0346829EC1B65 FOREIGN KEY (method_dimension_id) REFERENCES method_dimension (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        
        // Créer un index sur method_dimension_id
        $this->addSql('CREATE INDEX IDX_1EF0346829EC1B65 ON scores (method_dimension_id)');
    }

    public function down(Schema $schema): void
    {
        // Supprimer l'index et la contrainte sur method_dimension_id
        $this->addSql('DROP INDEX IDX_1EF0346829EC1B65');
        $this->addSql('ALTER TABLE scores DROP CONSTRAINT IF EXISTS FK_1EF0346829EC1B65');
        
        // Supprimer la colonne method_dimension_id
        $this->addSql('ALTER TABLE scores DROP COLUMN method_dimension_id');
        
        // Re-créer la colonne question_id
        $this->addSql('ALTER TABLE scores ADD question_id INT NOT NULL');
        
        // Re-créer la contrainte de foreign key vers questions
        $this->addSql('ALTER TABLE scores ADD CONSTRAINT FK_1EF03468FAF8F9EF FOREIGN KEY (question_id) REFERENCES questions (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        
        // Re-créer l'index unique sur question_id
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1EF03468FAF8F9EF ON scores (question_id)');
    }
}

