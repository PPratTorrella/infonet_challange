<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231008130753 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE character (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL, mass DOUBLE PRECISION NOT NULL, height DOUBLE PRECISION NOT NULL, gender VARCHAR(50) NOT NULL, picture VARCHAR(255) DEFAULT NULL)');
        $this->addSql('CREATE TABLE movies_characters (character_id INTEGER NOT NULL, movie_id INTEGER NOT NULL, PRIMARY KEY(character_id, movie_id), CONSTRAINT FK_6BDFABF81136BE75 FOREIGN KEY (character_id) REFERENCES character (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_6BDFABF88F93B6FC FOREIGN KEY (movie_id) REFERENCES movie (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('CREATE INDEX IDX_6BDFABF81136BE75 ON movies_characters (character_id)');
        $this->addSql('CREATE INDEX IDX_6BDFABF88F93B6FC ON movies_characters (movie_id)');
        $this->addSql('CREATE TABLE movie (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(255) NOT NULL)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE character');
        $this->addSql('DROP TABLE movies_characters');
        $this->addSql('DROP TABLE movie');
    }
}
