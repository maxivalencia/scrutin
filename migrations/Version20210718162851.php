<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210718162851 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE bureau (id INT AUTO_INCREMENT NOT NULL, fokontany_id INT NOT NULL, bureau VARCHAR(255) NOT NULL, INDEX IDX_166FDEC462907CDD (fokontany_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE candidat (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) DEFAULT NULL, photo VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE code (id INT AUTO_INCREMENT NOT NULL, code VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE commune (id INT AUTO_INCREMENT NOT NULL, district_id INT NOT NULL, commune VARCHAR(255) NOT NULL, INDEX IDX_E2E2D1EEB08FA272 (district_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE district (id INT AUTO_INCREMENT NOT NULL, region_id INT NOT NULL, district VARCHAR(255) NOT NULL, INDEX IDX_31C1548798260155 (region_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE electeur (id INT AUTO_INCREMENT NOT NULL, fokontany_id INT DEFAULT NULL, electeur INT NOT NULL, INDEX IDX_719667F062907CDD (fokontany_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fokontany (id INT AUTO_INCREMENT NOT NULL, commune_id INT NOT NULL, fokontany VARCHAR(255) NOT NULL, INDEX IDX_E9452B46131A4F72 (commune_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mode (id INT AUTO_INCREMENT NOT NULL, mode VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE population (id INT AUTO_INCREMENT NOT NULL, commune_id INT NOT NULL, population INT NOT NULL, INDEX IDX_B449A008131A4F72 (commune_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE province (id INT AUTO_INCREMENT NOT NULL, province VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE region (id INT AUTO_INCREMENT NOT NULL, province_id INT NOT NULL, region VARCHAR(255) NOT NULL, INDEX IDX_F62F176E946114A (province_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE resultat (id INT AUTO_INCREMENT NOT NULL, bureau_id INT NOT NULL, candidat_id INT NOT NULL, tour_id INT NOT NULL, vote_id INT DEFAULT NULL, session_id INT DEFAULT NULL, code_id INT DEFAULT NULL, utilisateur_id INT DEFAULT NULL, mode_id INT DEFAULT NULL, nombre INT NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_E7DB5DE232516FE2 (bureau_id), INDEX IDX_E7DB5DE28D0EB82 (candidat_id), INDEX IDX_E7DB5DE215ED8D43 (tour_id), INDEX IDX_E7DB5DE272DCDAFC (vote_id), INDEX IDX_E7DB5DE2613FECDF (session_id), INDEX IDX_E7DB5DE227DAFE17 (code_id), INDEX IDX_E7DB5DE2FB88E14F (utilisateur_id), INDEX IDX_E7DB5DE277E5854A (mode_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE session (id INT AUTO_INCREMENT NOT NULL, date DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tour (id INT AUTO_INCREMENT NOT NULL, tour VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) DEFAULT NULL, telephone VARCHAR(255) DEFAULT NULL, adresse VARCHAR(255) DEFAULT NULL, mail VARCHAR(255) DEFAULT NULL, fonction VARCHAR(255) DEFAULT NULL, photo VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE vote (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE bureau ADD CONSTRAINT FK_166FDEC462907CDD FOREIGN KEY (fokontany_id) REFERENCES fokontany (id)');
        $this->addSql('ALTER TABLE commune ADD CONSTRAINT FK_E2E2D1EEB08FA272 FOREIGN KEY (district_id) REFERENCES district (id)');
        $this->addSql('ALTER TABLE district ADD CONSTRAINT FK_31C1548798260155 FOREIGN KEY (region_id) REFERENCES region (id)');
        $this->addSql('ALTER TABLE electeur ADD CONSTRAINT FK_719667F062907CDD FOREIGN KEY (fokontany_id) REFERENCES fokontany (id)');
        $this->addSql('ALTER TABLE fokontany ADD CONSTRAINT FK_E9452B46131A4F72 FOREIGN KEY (commune_id) REFERENCES commune (id)');
        $this->addSql('ALTER TABLE population ADD CONSTRAINT FK_B449A008131A4F72 FOREIGN KEY (commune_id) REFERENCES commune (id)');
        $this->addSql('ALTER TABLE region ADD CONSTRAINT FK_F62F176E946114A FOREIGN KEY (province_id) REFERENCES province (id)');
        $this->addSql('ALTER TABLE resultat ADD CONSTRAINT FK_E7DB5DE232516FE2 FOREIGN KEY (bureau_id) REFERENCES bureau (id)');
        $this->addSql('ALTER TABLE resultat ADD CONSTRAINT FK_E7DB5DE28D0EB82 FOREIGN KEY (candidat_id) REFERENCES candidat (id)');
        $this->addSql('ALTER TABLE resultat ADD CONSTRAINT FK_E7DB5DE215ED8D43 FOREIGN KEY (tour_id) REFERENCES tour (id)');
        $this->addSql('ALTER TABLE resultat ADD CONSTRAINT FK_E7DB5DE272DCDAFC FOREIGN KEY (vote_id) REFERENCES vote (id)');
        $this->addSql('ALTER TABLE resultat ADD CONSTRAINT FK_E7DB5DE2613FECDF FOREIGN KEY (session_id) REFERENCES session (id)');
        $this->addSql('ALTER TABLE resultat ADD CONSTRAINT FK_E7DB5DE227DAFE17 FOREIGN KEY (code_id) REFERENCES code (id)');
        $this->addSql('ALTER TABLE resultat ADD CONSTRAINT FK_E7DB5DE2FB88E14F FOREIGN KEY (utilisateur_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE resultat ADD CONSTRAINT FK_E7DB5DE277E5854A FOREIGN KEY (mode_id) REFERENCES mode (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE resultat DROP FOREIGN KEY FK_E7DB5DE232516FE2');
        $this->addSql('ALTER TABLE resultat DROP FOREIGN KEY FK_E7DB5DE28D0EB82');
        $this->addSql('ALTER TABLE resultat DROP FOREIGN KEY FK_E7DB5DE227DAFE17');
        $this->addSql('ALTER TABLE fokontany DROP FOREIGN KEY FK_E9452B46131A4F72');
        $this->addSql('ALTER TABLE population DROP FOREIGN KEY FK_B449A008131A4F72');
        $this->addSql('ALTER TABLE commune DROP FOREIGN KEY FK_E2E2D1EEB08FA272');
        $this->addSql('ALTER TABLE bureau DROP FOREIGN KEY FK_166FDEC462907CDD');
        $this->addSql('ALTER TABLE electeur DROP FOREIGN KEY FK_719667F062907CDD');
        $this->addSql('ALTER TABLE resultat DROP FOREIGN KEY FK_E7DB5DE277E5854A');
        $this->addSql('ALTER TABLE region DROP FOREIGN KEY FK_F62F176E946114A');
        $this->addSql('ALTER TABLE district DROP FOREIGN KEY FK_31C1548798260155');
        $this->addSql('ALTER TABLE resultat DROP FOREIGN KEY FK_E7DB5DE2613FECDF');
        $this->addSql('ALTER TABLE resultat DROP FOREIGN KEY FK_E7DB5DE215ED8D43');
        $this->addSql('ALTER TABLE resultat DROP FOREIGN KEY FK_E7DB5DE2FB88E14F');
        $this->addSql('ALTER TABLE resultat DROP FOREIGN KEY FK_E7DB5DE272DCDAFC');
        $this->addSql('DROP TABLE bureau');
        $this->addSql('DROP TABLE candidat');
        $this->addSql('DROP TABLE code');
        $this->addSql('DROP TABLE commune');
        $this->addSql('DROP TABLE district');
        $this->addSql('DROP TABLE electeur');
        $this->addSql('DROP TABLE fokontany');
        $this->addSql('DROP TABLE mode');
        $this->addSql('DROP TABLE population');
        $this->addSql('DROP TABLE province');
        $this->addSql('DROP TABLE region');
        $this->addSql('DROP TABLE resultat');
        $this->addSql('DROP TABLE session');
        $this->addSql('DROP TABLE tour');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE vote');
    }
}
