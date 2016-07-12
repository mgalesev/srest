<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160712093927 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE tag_tagged_entities_tags');
        $this->addSql('ALTER TABLE tag_tagged_entity ADD type_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE tag_tagged_entity ADD CONSTRAINT FK_4A968D7DC54C8C93 FOREIGN KEY (type_id) REFERENCES tag_tag (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_4A968D7DC54C8C93 ON tag_tagged_entity (type_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE tag_tagged_entities_tags (tagged_entity_id INT NOT NULL, tag_id INT NOT NULL, INDEX IDX_C42A3D5CF97699BB (tagged_entity_id), INDEX IDX_C42A3D5CBAD26311 (tag_id), PRIMARY KEY(tagged_entity_id, tag_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE tag_tagged_entities_tags ADD CONSTRAINT FK_C42A3D5CBAD26311 FOREIGN KEY (tag_id) REFERENCES tag_tag (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tag_tagged_entities_tags ADD CONSTRAINT FK_C42A3D5CF97699BB FOREIGN KEY (tagged_entity_id) REFERENCES tag_tagged_entity (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tag_tagged_entity DROP FOREIGN KEY FK_4A968D7DC54C8C93');
        $this->addSql('DROP INDEX IDX_4A968D7DC54C8C93 ON tag_tagged_entity');
        $this->addSql('ALTER TABLE tag_tagged_entity DROP type_id');
    }
}
