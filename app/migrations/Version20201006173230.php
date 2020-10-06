<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201006173230 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE line (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, end VARCHAR(255) NOT NULL, start VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE line_street (line_id INT NOT NULL, street_id INT NOT NULL, INDEX IDX_84A085654D7B7542 (line_id), INDEX IDX_84A0856587CF8EB (street_id), PRIMARY KEY(line_id, street_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE street (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE line_street ADD CONSTRAINT FK_84A085654D7B7542 FOREIGN KEY (line_id) REFERENCES line (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE line_street ADD CONSTRAINT FK_84A0856587CF8EB FOREIGN KEY (street_id) REFERENCES street (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE line_street DROP FOREIGN KEY FK_84A085654D7B7542');
        $this->addSql('ALTER TABLE line_street DROP FOREIGN KEY FK_84A0856587CF8EB');
        $this->addSql('DROP TABLE line');
        $this->addSql('DROP TABLE line_street');
        $this->addSql('DROP TABLE street');
    }
}
