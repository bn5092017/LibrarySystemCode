<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170422200341 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(255) NOT NULL, firstName VARCHAR(255) NOT NULL, lastname VARCHAR(255) NOT NULL, address VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, role VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE books CHANGE title title VARCHAR(255) NOT NULL, CHANGE author author VARCHAR(255) NOT NULL, CHANGE publisher publisher VARCHAR(255) NOT NULL, CHANGE date date INT NOT NULL, CHANGE catagory catagory VARCHAR(255) NOT NULL, CHANGE description description LONGTEXT NOT NULL');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE user');
        $this->addSql('ALTER TABLE books CHANGE title title VARCHAR(50) DEFAULT NULL COLLATE latin1_swedish_ci, CHANGE author author VARCHAR(50) DEFAULT NULL COLLATE latin1_swedish_ci, CHANGE publisher publisher VARCHAR(50) DEFAULT NULL COLLATE latin1_swedish_ci, CHANGE date date DATE DEFAULT NULL, CHANGE catagory catagory VARCHAR(50) DEFAULT NULL COLLATE latin1_swedish_ci, CHANGE description description TINYTEXT DEFAULT NULL COLLATE latin1_swedish_ci');
    }
}
