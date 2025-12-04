<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251030165016 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE reservation_transfert (id INT AUTO_INCREMENT NOT NULL, trajet_transfert_id INT NOT NULL, pickup_date DATETIME NOT NULL, pickup_time TIME NOT NULL, pickup_location VARCHAR(255) NOT NULL, dropoff_location VARCHAR(255) NOT NULL, transfer_type VARCHAR(255) NOT NULL, persons INT NOT NULL, return_pickup_date DATETIME DEFAULT NULL, return_pickup_time TIME DEFAULT NULL, return_pickup_location VARCHAR(255) DEFAULT NULL, return_dropoff_location VARCHAR(255) DEFAULT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, tel VARCHAR(50) NOT NULL, whatsapp_number VARCHAR(50) DEFAULT NULL, flight_number VARCHAR(50) DEFAULT NULL, comments LONGTEXT DEFAULT NULL, prix_total NUMERIC(10, 2) NOT NULL, statut VARCHAR(50) NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_409CD24556A9926 (trajet_transfert_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE transfere (id INT AUTO_INCREMENT NOT NULL, lieu_depart VARCHAR(255) NOT NULL, lieu_arrivee VARCHAR(255) NOT NULL, prix NUMERIC(10, 2) NOT NULL, image VARCHAR(255) DEFAULT NULL, duree VARCHAR(50) DEFAULT NULL, actif TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE reservation_transfert ADD CONSTRAINT FK_409CD24556A9926 FOREIGN KEY (trajet_transfert_id) REFERENCES transfere (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reservation_transfert DROP FOREIGN KEY FK_409CD24556A9926');
        $this->addSql('DROP TABLE reservation_transfert');
        $this->addSql('DROP TABLE transfere');
    }
}
