<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181019185701 extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf('sqlite' !== $this->connection->getDatabasePlatform()->getName(), 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('CREATE TEMPORARY TABLE __temp__score AS SELECT id, name, score, average_draw_time, total_time, played_date FROM score');
        $this->addSql('DROP TABLE score');
        $this->addSql('CREATE TABLE score (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(60) DEFAULT NULL, score INTEGER DEFAULT NULL, average_draw_time VARCHAR(10) DEFAULT NULL, total_time VARCHAR(10) DEFAULT NULL, played_date DATETIME DEFAULT NULL, draws INTEGER DEFAULT NULL)');
        $this->addSql('INSERT INTO score (id, name, score, average_draw_time, total_time, played_date) SELECT id, name, score, average_draw_time, total_time, played_date FROM __temp__score');
        $this->addSql('DROP TABLE __temp__score');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf('sqlite' !== $this->connection->getDatabasePlatform()->getName(), 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('CREATE TEMPORARY TABLE __temp__score AS SELECT id, name, score, average_draw_time, total_time, played_date FROM score');
        $this->addSql('DROP TABLE score');
        $this->addSql('CREATE TABLE score (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, name VARCHAR(60) NOT NULL COLLATE BINARY, score INTEGER NOT NULL, average_draw_time NUMERIC(5, 3) NOT NULL, total_time VARCHAR(10) NOT NULL COLLATE BINARY, played_date DATETIME NOT NULL)');
        $this->addSql('INSERT INTO score (id, name, score, average_draw_time, total_time, played_date) SELECT id, name, score, average_draw_time, total_time, played_date FROM __temp__score');
        $this->addSql('DROP TABLE __temp__score');
    }
}
