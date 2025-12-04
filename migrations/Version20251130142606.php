<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251130142606 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE reservation_excursion (id INT AUTO_INCREMENT NOT NULL, excursion_id INT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, adult INT NOT NULL, child INT NOT NULL, date_heure DATETIME NOT NULL, localisation_point VARCHAR(255) NOT NULL, date_creation DATETIME NOT NULL, statut VARCHAR(50) NOT NULL, INDEX IDX_814F86B04AB4296F (excursion_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE reservation_excursion ADD CONSTRAINT FK_814F86B04AB4296F FOREIGN KEY (excursion_id) REFERENCES excursion (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reservation_excursion DROP FOREIGN KEY FK_814F86B04AB4296F');
        $this->addSql('DROP TABLE reservation_excursion');
    }
}
