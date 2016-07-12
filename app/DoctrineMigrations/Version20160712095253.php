<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160712095253 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE tag_tagged_entity DROP FOREIGN KEY FK_4A968D7DC54C8C93');
        $this->addSql('DROP INDEX IDX_4A968D7DC54C8C93 ON tag_tagged_entity');
        $this->addSql('ALTER TABLE tag_tagged_entity CHANGE type_id tag_id INT DEFAULT NULL, CHANGE type resource_type VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE tag_tagged_entity ADD CONSTRAINT FK_4A968D7DBAD26311 FOREIGN KEY (tag_id) REFERENCES tag_tag (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_4A968D7DBAD26311 ON tag_tagged_entity (tag_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE tag_tagged_entity DROP FOREIGN KEY FK_4A968D7DBAD26311');
        $this->addSql('DROP INDEX IDX_4A968D7DBAD26311 ON tag_tagged_entity');
        $this->addSql('ALTER TABLE tag_tagged_entity CHANGE tag_id type_id INT DEFAULT NULL, CHANGE resource_type type VARCHAR(255) NOT NULL COLLATE utf8_unicode_ci');
        $this->addSql('ALTER TABLE tag_tagged_entity ADD CONSTRAINT FK_4A968D7DC54C8C93 FOREIGN KEY (type_id) REFERENCES tag_tag (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_4A968D7DC54C8C93 ON tag_tagged_entity (type_id)');
    }
}
