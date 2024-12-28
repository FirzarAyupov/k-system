<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20241228172208 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE teacher_detail DROP CONSTRAINT fk_3b8dad6641807e1d');
        $this->addSql('DROP TABLE teacher_detail');
        $this->addSql('ALTER TABLE teacher ADD birth_date TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL');
        $this->addSql('ALTER TABLE teacher ADD email VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE teacher ADD address VARCHAR(500) DEFAULT NULL');
        $this->addSql('ALTER TABLE teacher ADD experience_years VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE teacher ADD qualification_category VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE teacher ADD last_attestation_year INT DEFAULT NULL');
        $this->addSql('ALTER TABLE teacher ADD next_attestation_year INT DEFAULT NULL');
        $this->addSql('ALTER TABLE teacher RENAME COLUMN middle_name TO patronymic');
        $this->addSql('COMMENT ON COLUMN teacher.birth_date IS \'(DC2Type:datetime_immutable)\'');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('CREATE SEQUENCE teacher_detail_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE teacher_detail (id SERIAL NOT NULL, teacher_id INT NOT NULL, birth_date TIMESTAMP(0) WITHOUT TIME ZONE DEFAULT NULL, address VARCHAR(500) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX idx_3b8dad6641807e1d ON teacher_detail (teacher_id)');
        $this->addSql('COMMENT ON COLUMN teacher_detail.birth_date IS \'(DC2Type:datetime_immutable)\'');
        $this->addSql('ALTER TABLE teacher_detail ADD CONSTRAINT fk_3b8dad6641807e1d FOREIGN KEY (teacher_id) REFERENCES teacher (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE teacher ADD middle_name VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE teacher DROP patronymic');
        $this->addSql('ALTER TABLE teacher DROP birth_date');
        $this->addSql('ALTER TABLE teacher DROP email');
        $this->addSql('ALTER TABLE teacher DROP address');
        $this->addSql('ALTER TABLE teacher DROP experience_years');
        $this->addSql('ALTER TABLE teacher DROP qualification_category');
        $this->addSql('ALTER TABLE teacher DROP last_attestation_year');
        $this->addSql('ALTER TABLE teacher DROP next_attestation_year');
    }
}
