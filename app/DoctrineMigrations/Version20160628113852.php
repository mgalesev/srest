<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160628113852 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE survey_result (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, survey_id INT DEFAULT NULL, question_id INT DEFAULT NULL, answer_id INT DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_3B64097FA76ED395 (user_id), INDEX IDX_3B64097FB3FE509D (survey_id), INDEX IDX_3B64097F1E27F6BF (question_id), INDEX IDX_3B64097FAA334807 (answer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE survey_survey (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, title VARCHAR(255) DEFAULT NULL, alias VARCHAR(255) NOT NULL, public TINYINT(1) NOT NULL, editable TINYINT(1) NOT NULL, locked TINYINT(1) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_85515390A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE survey_question (id INT AUTO_INCREMENT NOT NULL, survey_id INT DEFAULT NULL, question LONGTEXT DEFAULT NULL, weight INT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_EA000F69B3FE509D (survey_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE survey_answer (id INT AUTO_INCREMENT NOT NULL, question_id INT DEFAULT NULL, answer LONGTEXT DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_F2D382491E27F6BF (question_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE survey_result ADD CONSTRAINT FK_3B64097FA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE survey_result ADD CONSTRAINT FK_3B64097FB3FE509D FOREIGN KEY (survey_id) REFERENCES survey_survey (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE survey_result ADD CONSTRAINT FK_3B64097F1E27F6BF FOREIGN KEY (question_id) REFERENCES survey_question (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE survey_result ADD CONSTRAINT FK_3B64097FAA334807 FOREIGN KEY (answer_id) REFERENCES survey_answer (id)');
        $this->addSql('ALTER TABLE survey_survey ADD CONSTRAINT FK_85515390A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE survey_question ADD CONSTRAINT FK_EA000F69B3FE509D FOREIGN KEY (survey_id) REFERENCES survey_survey (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE survey_answer ADD CONSTRAINT FK_F2D382491E27F6BF FOREIGN KEY (question_id) REFERENCES survey_question (id) ON DELETE CASCADE');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE survey_result DROP FOREIGN KEY FK_3B64097FB3FE509D');
        $this->addSql('ALTER TABLE survey_question DROP FOREIGN KEY FK_EA000F69B3FE509D');
        $this->addSql('ALTER TABLE survey_result DROP FOREIGN KEY FK_3B64097F1E27F6BF');
        $this->addSql('ALTER TABLE survey_answer DROP FOREIGN KEY FK_F2D382491E27F6BF');
        $this->addSql('ALTER TABLE survey_result DROP FOREIGN KEY FK_3B64097FAA334807');
        $this->addSql('DROP TABLE survey_result');
        $this->addSql('DROP TABLE survey_survey');
        $this->addSql('DROP TABLE survey_question');
        $this->addSql('DROP TABLE survey_answer');
    }
}
