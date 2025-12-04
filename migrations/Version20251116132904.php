<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251116132904 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE avis_excursion (id INT AUTO_INCREMENT NOT NULL, excursion_id INT NOT NULL, user_id INT DEFAULT NULL, note INT NOT NULL, commentaire LONGTEXT DEFAULT NULL, created_at DATETIME NOT NULL, INDEX IDX_3D5DF8EE4AB4296F (excursion_id), INDEX IDX_3D5DF8EEA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE faqexcursion (id INT AUTO_INCREMENT NOT NULL, excursion_id INT NOT NULL, question VARCHAR(255) NOT NULL, reponse LONGTEXT NOT NULL, ordre INT DEFAULT NULL, INDEX IDX_496A5B584AB4296F (excursion_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE inclus_excursion (id INT AUTO_INCREMENT NOT NULL, excursion_id INT NOT NULL, item VARCHAR(255) NOT NULL, ordre INT DEFAULT NULL, INDEX IDX_2D0EB09F4AB4296F (excursion_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE itineraire_excursion (id INT AUTO_INCREMENT NOT NULL, excursion_id INT NOT NULL, titre_etape VARCHAR(255) NOT NULL, description_etape LONGTEXT DEFAULT NULL, ordre INT DEFAULT NULL, INDEX IDX_CD58DB854AB4296F (excursion_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE non_inclus_excursion (id INT AUTO_INCREMENT NOT NULL, excursion_id INT NOT NULL, item VARCHAR(255) NOT NULL, ordre INT DEFAULT NULL, INDEX IDX_A2FCC24A4AB4296F (excursion_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE avis_excursion ADD CONSTRAINT FK_3D5DF8EE4AB4296F FOREIGN KEY (excursion_id) REFERENCES excursion (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE avis_excursion ADD CONSTRAINT FK_3D5DF8EEA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE faqexcursion ADD CONSTRAINT FK_496A5B584AB4296F FOREIGN KEY (excursion_id) REFERENCES excursion (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE inclus_excursion ADD CONSTRAINT FK_2D0EB09F4AB4296F FOREIGN KEY (excursion_id) REFERENCES excursion (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE itineraire_excursion ADD CONSTRAINT FK_CD58DB854AB4296F FOREIGN KEY (excursion_id) REFERENCES excursion (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE non_inclus_excursion ADD CONSTRAINT FK_A2FCC24A4AB4296F FOREIGN KEY (excursion_id) REFERENCES excursion (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE avis_excursion DROP FOREIGN KEY FK_3D5DF8EE4AB4296F');
        $this->addSql('ALTER TABLE avis_excursion DROP FOREIGN KEY FK_3D5DF8EEA76ED395');
        $this->addSql('ALTER TABLE faqexcursion DROP FOREIGN KEY FK_496A5B584AB4296F');
        $this->addSql('ALTER TABLE inclus_excursion DROP FOREIGN KEY FK_2D0EB09F4AB4296F');
        $this->addSql('ALTER TABLE itineraire_excursion DROP FOREIGN KEY FK_CD58DB854AB4296F');
        $this->addSql('ALTER TABLE non_inclus_excursion DROP FOREIGN KEY FK_A2FCC24A4AB4296F');
        $this->addSql('DROP TABLE avis_excursion');
        $this->addSql('DROP TABLE faqexcursion');
        $this->addSql('DROP TABLE inclus_excursion');
        $this->addSql('DROP TABLE itineraire_excursion');
        $this->addSql('DROP TABLE non_inclus_excursion');
    }
}
