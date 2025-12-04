<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251116142332 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE excursion DROP inclus, DROP exclus, CHANGE description description LONGTEXT DEFAULT NULL, CHANGE duree duree VARCHAR(255) DEFAULT NULL, CHANGE cancellation cancellation LONGTEXT DEFAULT NULL, CHANGE prix_par_personne prix_par_personne VARCHAR(255) NOT NULL, CHANGE created_at created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', CHANGE updated_at updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE excursion ADD inclus VARCHAR(255) DEFAULT NULL, ADD exclus VARCHAR(255) DEFAULT NULL, CHANGE duree duree VARCHAR(100) DEFAULT NULL, CHANGE prix_par_personne prix_par_personne NUMERIC(10, 2) NOT NULL, CHANGE description description LONGTEXT NOT NULL, CHANGE cancellation cancellation VARCHAR(255) DEFAULT NULL, CHANGE created_at created_at DATETIME NOT NULL, CHANGE updated_at updated_at DATETIME DEFAULT NULL');
    }
}
