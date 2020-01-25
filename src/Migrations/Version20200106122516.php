<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200106122516 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mssql', 'Migration can only be executed safely on \'mssql\'.');

        $this->addSql('CREATE TABLE ad (id INT IDENTITY NOT NULL, author_id INT NOT NULL, title NVARCHAR(255) NOT NULL, slug NVARCHAR(255) NOT NULL, price DOUBLE PRECISION NOT NULL, introduction VARCHAR(MAX) NOT NULL, content VARCHAR(MAX) NOT NULL, cover_image NVARCHAR(255) NOT NULL, rooms INT NOT NULL, PRIMARY KEY (id))');
        $this->addSql('CREATE INDEX IDX_77E0ED58F675F31B ON ad (author_id)');
        $this->addSql('CREATE TABLE end_user (id INT IDENTITY NOT NULL, first_name NVARCHAR(255) NOT NULL, last_name NVARCHAR(255) NOT NULL, email NVARCHAR(255) NOT NULL, picture NVARCHAR(255), hash NVARCHAR(255) NOT NULL, introduction NVARCHAR(255) NOT NULL, description VARCHAR(MAX) NOT NULL, slug NVARCHAR(255) NOT NULL, PRIMARY KEY (id))');
        $this->addSql('CREATE TABLE image (id INT IDENTITY NOT NULL, ad_id INT NOT NULL, url NVARCHAR(255) NOT NULL, caption NVARCHAR(255) NOT NULL, PRIMARY KEY (id))');
        $this->addSql('CREATE INDEX IDX_C53D045F4F34D596 ON image (ad_id)');
        $this->addSql('ALTER TABLE ad ADD CONSTRAINT FK_77E0ED58F675F31B FOREIGN KEY (author_id) REFERENCES end_user (id)');
        $this->addSql('ALTER TABLE image ADD CONSTRAINT FK_C53D045F4F34D596 FOREIGN KEY (ad_id) REFERENCES ad (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mssql', 'Migration can only be executed safely on \'mssql\'.');

        $this->addSql('CREATE SCHEMA db_accessadmin');
        $this->addSql('CREATE SCHEMA db_backupoperator');
        $this->addSql('CREATE SCHEMA db_datareader');
        $this->addSql('CREATE SCHEMA db_datawriter');
        $this->addSql('CREATE SCHEMA db_ddladmin');
        $this->addSql('CREATE SCHEMA db_denydatareader');
        $this->addSql('CREATE SCHEMA db_denydatawriter');
        $this->addSql('CREATE SCHEMA db_owner');
        $this->addSql('CREATE SCHEMA db_securityadmin');
        $this->addSql('CREATE SCHEMA dbo');
        $this->addSql('ALTER TABLE image DROP CONSTRAINT FK_C53D045F4F34D596');
        $this->addSql('ALTER TABLE ad DROP CONSTRAINT FK_77E0ED58F675F31B');
        $this->addSql('DROP TABLE ad');
        $this->addSql('DROP TABLE end_user');
        $this->addSql('DROP TABLE image');
    }
}
