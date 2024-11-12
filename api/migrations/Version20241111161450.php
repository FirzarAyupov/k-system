<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241111161450 extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE teacher (id SERIAL NOT NULL, user_id UUID DEFAULT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, middle_name VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_B0F6A6D5A76ED395 ON teacher (user_id)');
        $this->addSql('COMMENT ON COLUMN teacher.user_id IS \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE teacher ADD CONSTRAINT FK_B0F6A6D5A76ED395 FOREIGN KEY (user_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('DROP INDEX uniq_identifier_email');
        $this->addSql('ALTER TABLE "user" RENAME COLUMN email TO login');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_IDENTIFIER_LOGIN ON "user" (login)');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE teacher DROP CONSTRAINT FK_B0F6A6D5A76ED395');
        $this->addSql('DROP TABLE teacher');
        $this->addSql('DROP INDEX UNIQ_IDENTIFIER_LOGIN');
        $this->addSql('ALTER TABLE "user" RENAME COLUMN login TO email');
        $this->addSql('CREATE UNIQUE INDEX uniq_identifier_email ON "user" (email)');
    }
}
