<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251102110538 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE excursion (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, categorie VARCHAR(255) DEFAULT NULL, duree VARCHAR(100) DEFAULT NULL, cancellation VARCHAR(255) DEFAULT NULL, localisation VARCHAR(255) DEFAULT NULL, map_url LONGTEXT DEFAULT NULL, a_propos LONGTEXT DEFAULT NULL, inclus JSON DEFAULT NULL, exclus JSON DEFAULT NULL, prix_par_personne NUMERIC(10, 2) NOT NULL, image_principale VARCHAR(255) DEFAULT NULL, actif TINYINT(1) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE image_excursion (id INT AUTO_INCREMENT NOT NULL, excursion_id INT NOT NULL, image_url VARCHAR(255) NOT NULL, is_principale TINYINT(1) NOT NULL, ordre_affichage INT DEFAULT NULL, INDEX IDX_438A3C7B4AB4296F (excursion_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE image_excursion ADD CONSTRAINT FK_438A3C7B4AB4296F FOREIGN KEY (excursion_id) REFERENCES excursion (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE image_excursion DROP FOREIGN KEY FK_438A3C7B4AB4296F');
        $this->addSql('DROP TABLE excursion');
        $this->addSql('DROP TABLE image_excursion');
    }
}
