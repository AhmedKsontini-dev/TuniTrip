<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260102002043 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE excursion ADD slug VARCHAR(255) NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_9B08E72F989D9B62 ON excursion (slug)');
        $this->addSql('ALTER TABLE reservation_transfert CHANGE prix_total prix_total DOUBLE PRECISION DEFAULT NULL');
        $this->addSql('ALTER TABLE transfere CHANGE prix prix DOUBLE PRECISION NOT NULL');
        $this->addSql('ALTER TABLE voitures ADD slug VARCHAR(255) DEFAULT NULL, CHANGE prix_mois prix_mois DOUBLE PRECISION NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8B58301B989D9B62 ON voitures (slug)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP INDEX UNIQ_9B08E72F989D9B62 ON excursion');
        $this->addSql('ALTER TABLE excursion DROP slug');
        $this->addSql('ALTER TABLE reservation_transfert CHANGE prix_total prix_total NUMERIC(10, 2) NOT NULL');
        $this->addSql('ALTER TABLE transfere CHANGE prix prix NUMERIC(10, 2) NOT NULL');
        $this->addSql('DROP INDEX UNIQ_8B58301B989D9B62 ON voitures');
        $this->addSql('ALTER TABLE voitures DROP slug, CHANGE prix_mois prix_mois NUMERIC(10, 2) NOT NULL');
    }
}
