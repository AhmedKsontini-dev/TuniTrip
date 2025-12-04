<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251108100820 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE reservation_voiture (id INT AUTO_INCREMENT NOT NULL, voiture_id INT NOT NULL, nom VARCHAR(100) NOT NULL, prenom VARCHAR(100) NOT NULL, date_naissance DATE NOT NULL, lieu_naissance VARCHAR(150) NOT NULL, nationalite VARCHAR(100) NOT NULL, adresse VARCHAR(255) NOT NULL, tel VARCHAR(20) NOT NULL, num_cin_passport VARCHAR(50) NOT NULL, cin_delivre_le DATE DEFAULT NULL, num_permis VARCHAR(50) DEFAULT NULL, permis_delivre_le DATE DEFAULT NULL, permis_lieu_delivrance VARCHAR(150) DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_8E773A8A181A8BA (voiture_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE reservation_voiture ADD CONSTRAINT FK_8E773A8A181A8BA FOREIGN KEY (voiture_id) REFERENCES voitures (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reservation_voiture DROP FOREIGN KEY FK_8E773A8A181A8BA');
        $this->addSql('DROP TABLE reservation_voiture');
    }
}
