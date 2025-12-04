<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251117142402 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE itineraire_photo (id INT AUTO_INCREMENT NOT NULL, itineraire_id INT NOT NULL, image_url VARCHAR(255) NOT NULL, legende VARCHAR(255) DEFAULT NULL, ordre INT DEFAULT NULL, INDEX IDX_92D34557A9B853B8 (itineraire_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE itineraire_photo ADD CONSTRAINT FK_92D34557A9B853B8 FOREIGN KEY (itineraire_id) REFERENCES itineraire_excursion (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE itineraire_photo DROP FOREIGN KEY FK_92D34557A9B853B8');
        $this->addSql('DROP TABLE itineraire_photo');
    }
}
