<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20140405154751 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("CREATE TABLE owner (id INT AUTO_INCREMENT NOT NULL, type LONGTEXT NOT NULL, firstName VARCHAR(255) NOT NULL, lastName VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, phoneNumber VARCHAR(255) NOT NULL, mobileNumber VARCHAR(255) NOT NULL, addressLine1 VARCHAR(255) NOT NULL, addressLine2 VARCHAR(255) NOT NULL, addressLine3 VARCHAR(255) NOT NULL, city VARCHAR(255) NOT NULL, country VARCHAR(255) NOT NULL, postcode VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE issue (id INT AUTO_INCREMENT NOT NULL, item_id INT DEFAULT NULL, description LONGTEXT NOT NULL, INDEX IDX_12AD233E126F525E (item_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("CREATE TABLE item (id INT AUTO_INCREMENT NOT NULL, owner_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, host VARCHAR(255) NOT NULL, summary LONGTEXT NOT NULL, description LONGTEXT NOT NULL, accessType VARCHAR(255) NOT NULL, noOfViews INT NOT NULL, noOfAccessRequests INT NOT NULL, location VARCHAR(255) DEFAULT NULL, fileFormat VARCHAR(255) DEFAULT NULL, technology VARCHAR(255) DEFAULT NULL, phenotype VARCHAR(255) DEFAULT NULL, tagCloud VARCHAR(255) DEFAULT NULL, INDEX IDX_1F1B251E7E3C61F9 (owner_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB");
        $this->addSql("ALTER TABLE issue ADD CONSTRAINT FK_12AD233E126F525E FOREIGN KEY (item_id) REFERENCES item (id)");
        $this->addSql("ALTER TABLE item ADD CONSTRAINT FK_1F1B251E7E3C61F9 FOREIGN KEY (owner_id) REFERENCES owner (id)");
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("ALTER TABLE item DROP FOREIGN KEY FK_1F1B251E7E3C61F9");
        $this->addSql("ALTER TABLE issue DROP FOREIGN KEY FK_12AD233E126F525E");
        $this->addSql("DROP TABLE owner");
        $this->addSql("DROP TABLE issue");
        $this->addSql("DROP TABLE item");
    }
}
