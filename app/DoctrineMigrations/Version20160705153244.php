<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160705153244 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE tag_tag (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tag_tagged_entity (id INT AUTO_INCREMENT NOT NULL, model VARCHAR(255) NOT NULL, modelId INT NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tag_tagged_entities_tags (tagged_entity_id INT NOT NULL, tag_id INT NOT NULL, INDEX IDX_C42A3D5CF97699BB (tagged_entity_id), INDEX IDX_C42A3D5CBAD26311 (tag_id), PRIMARY KEY(tagged_entity_id, tag_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE tag_tagged_entities_tags ADD CONSTRAINT FK_C42A3D5CF97699BB FOREIGN KEY (tagged_entity_id) REFERENCES tag_tagged_entity (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE tag_tagged_entities_tags ADD CONSTRAINT FK_C42A3D5CBAD26311 FOREIGN KEY (tag_id) REFERENCES tag_tag (id) ON DELETE CASCADE');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE tag_tagged_entities_tags DROP FOREIGN KEY FK_C42A3D5CBAD26311');
        $this->addSql('ALTER TABLE tag_tagged_entities_tags DROP FOREIGN KEY FK_C42A3D5CF97699BB');
        $this->addSql('DROP TABLE tag_tag');
        $this->addSql('DROP TABLE tag_tagged_entity');
        $this->addSql('DROP TABLE tag_tagged_entities_tags');
    }
}
