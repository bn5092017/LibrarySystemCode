<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20170421205028 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE loans');
        $this->addSql('ALTER TABLE user CHANGE id id INT AUTO_INCREMENT NOT NULL, CHANGE username username VARCHAR(255) NOT NULL, CHANGE firstname firstName VARCHAR(255) NOT NULL, CHANGE lastname lastname VARCHAR(255) NOT NULL, CHANGE address address VARCHAR(255) NOT NULL, CHANGE email email VARCHAR(255) NOT NULL, CHANGE password password VARCHAR(255) NOT NULL, CHANGE role role VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE books CHANGE title title VARCHAR(255) NOT NULL, CHANGE author author VARCHAR(255) NOT NULL, CHANGE publisher publisher VARCHAR(255) NOT NULL, CHANGE date date INT NOT NULL, CHANGE catagory catagory VARCHAR(255) NOT NULL, CHANGE description description LONGTEXT NOT NULL');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE loans (loanId INT AUTO_INCREMENT NOT NULL, userId INT DEFAULT NULL, bookId INT DEFAULT NULL, dateOut DATE DEFAULT NULL, dateDueBack DATE DEFAULT NULL, PRIMARY KEY(loanId)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE books CHANGE title title VARCHAR(50) DEFAULT NULL COLLATE latin1_swedish_ci, CHANGE author author VARCHAR(50) DEFAULT NULL COLLATE latin1_swedish_ci, CHANGE publisher publisher VARCHAR(50) DEFAULT NULL COLLATE latin1_swedish_ci, CHANGE date date DATE DEFAULT NULL, CHANGE catagory catagory VARCHAR(50) DEFAULT NULL COLLATE latin1_swedish_ci, CHANGE description description TINYTEXT DEFAULT NULL COLLATE latin1_swedish_ci');
        $this->addSql('ALTER TABLE user CHANGE id id INT UNSIGNED AUTO_INCREMENT NOT NULL, CHANGE username username VARCHAR(30) DEFAULT NULL COLLATE latin1_swedish_ci, CHANGE firstName firstname VARCHAR(30) NOT NULL COLLATE latin1_swedish_ci, CHANGE lastname lastname VARCHAR(30) NOT NULL COLLATE latin1_swedish_ci, CHANGE address address VARCHAR(100) NOT NULL COLLATE latin1_swedish_ci, CHANGE email email VARCHAR(50) DEFAULT NULL COLLATE latin1_swedish_ci, CHANGE password password CHAR(60) DEFAULT NULL COLLATE latin1_swedish_ci, CHANGE role role VARCHAR(10) DEFAULT NULL COLLATE latin1_swedish_ci');
    }
}
