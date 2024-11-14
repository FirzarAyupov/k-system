<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241114164857 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE teacher_detail (id SERIAL NOT NULL, teacher_id INT NOT NULL, birth_date TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, address VARCHAR(500) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_3B8DAD6641807E1D ON teacher_detail (teacher_id)');
        $this->addSql('COMMENT ON COLUMN teacher_detail.birth_date IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE teacher_detail ADD CONSTRAINT FK_3B8DAD6641807E1D FOREIGN KEY (teacher_id) REFERENCES teacher (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE teacher_detail DROP CONSTRAINT FK_3B8DAD6641807E1D');
        $this->addSql('DROP TABLE teacher_detail');
    }
}
