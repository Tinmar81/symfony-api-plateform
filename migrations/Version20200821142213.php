<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200821142213 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE restaurant_image (id INT AUTO_INCREMENT NOT NULL, filename VARCHAR(255) NOT NULL, path VARCHAR(255) NOT NULL, format VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE restaurant ADD image_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE restaurant ADD CONSTRAINT FK_EB95123F3DA5256D FOREIGN KEY (image_id) REFERENCES restaurant_image (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_EB95123F3DA5256D ON restaurant (image_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE restaurant DROP FOREIGN KEY FK_EB95123F3DA5256D');
        $this->addSql('DROP TABLE restaurant_image');
        $this->addSql('DROP INDEX UNIQ_EB95123F3DA5256D ON restaurant');
        $this->addSql('ALTER TABLE restaurant DROP image_id');
    }
}
