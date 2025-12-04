<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251203130254 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE avis_excursion DROP FOREIGN KEY FK_3D5DF8EEA76ED395');
        $this->addSql('DROP INDEX IDX_3D5DF8EEA76ED395 ON avis_excursion');
        $this->addSql('ALTER TABLE avis_excursion ADD question LONGTEXT NOT NULL, ADD reponse LONGTEXT NOT NULL, ADD date_creation DATETIME DEFAULT NULL, DROP user_id, DROP commentaire, DROP created_at, CHANGE note ordre INT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE avis_excursion ADD user_id INT DEFAULT NULL, ADD commentaire LONGTEXT DEFAULT NULL, ADD created_at DATETIME NOT NULL, DROP question, DROP reponse, DROP date_creation, CHANGE ordre note INT NOT NULL');
        $this->addSql('ALTER TABLE avis_excursion ADD CONSTRAINT FK_3D5DF8EEA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_3D5DF8EEA76ED395 ON avis_excursion (user_id)');
    }
}
