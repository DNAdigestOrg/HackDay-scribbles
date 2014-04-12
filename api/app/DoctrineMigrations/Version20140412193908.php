<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20140412193908 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("ALTER TABLE owner CHANGE type type LONGTEXT DEFAULT NULL, CHANGE email email VARCHAR(255) DEFAULT NULL, CHANGE phoneNumber phoneNumber VARCHAR(255) DEFAULT NULL, CHANGE mobileNumber mobileNumber VARCHAR(255) DEFAULT NULL, CHANGE addressLine1 addressLine1 VARCHAR(255) DEFAULT NULL, CHANGE addressLine2 addressLine2 VARCHAR(255) DEFAULT NULL, CHANGE addressLine3 addressLine3 VARCHAR(255) DEFAULT NULL, CHANGE city city VARCHAR(255) DEFAULT NULL, CHANGE country country VARCHAR(255) DEFAULT NULL, CHANGE postcode postcode VARCHAR(255) DEFAULT NULL");
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != "mysql", "Migration can only be executed safely on 'mysql'.");
        
        $this->addSql("ALTER TABLE owner CHANGE type type LONGTEXT NOT NULL, CHANGE email email VARCHAR(255) NOT NULL, CHANGE phoneNumber phoneNumber VARCHAR(255) NOT NULL, CHANGE mobileNumber mobileNumber VARCHAR(255) NOT NULL, CHANGE addressLine1 addressLine1 VARCHAR(255) NOT NULL, CHANGE addressLine2 addressLine2 VARCHAR(255) NOT NULL, CHANGE addressLine3 addressLine3 VARCHAR(255) NOT NULL, CHANGE city city VARCHAR(255) NOT NULL, CHANGE country country VARCHAR(255) NOT NULL, CHANGE postcode postcode VARCHAR(255) NOT NULL");
    }
}
