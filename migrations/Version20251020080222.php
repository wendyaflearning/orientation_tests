<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251020080222 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER INDEX idx_1ef0346829ec1b65 RENAME TO IDX_750375E29EC1B65');
        $this->addSql('ALTER TABLE users ADD password VARCHAR(255) DEFAULT NULL');
        $this->addSql("ALTER TABLE users ADD roles JSON DEFAULT '[]'::json NOT NULL");
        
        // Mise à jour des utilisateurs existants avec un mot de passe par défaut "test" (hashé)
        // Hash bcrypt de "test"
        $this->addSql("UPDATE users SET password = '\$2y\$13\$MoTBmW98afYKwaCPKExva.2sCBKVjsIOJyICHdc6wrFa08SWXLxGC' WHERE password IS NULL");
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER INDEX idx_750375e29ec1b65 RENAME TO idx_1ef0346829ec1b65');
        $this->addSql('ALTER TABLE users DROP password');
        $this->addSql('ALTER TABLE users DROP roles');
    }
}
