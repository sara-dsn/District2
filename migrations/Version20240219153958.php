<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240219153958 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE categorie CHANGE libelle libelle VARCHAR(50) NOT NULL, CHANGE image image VARCHAR(50) NOT NULL, CHANGE active active TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY commande_ibfk_1');
        $this->addSql('DROP INDEX id_plat ON commande');
        $this->addSql('ALTER TABLE commande ADD commande_id INT DEFAULT NULL, DROP id_plat, DROP quantite, DROP nom_client, DROP telephone_client, DROP email_client, DROP adresse_client, CHANGE total total NUMERIC(6, 2) NOT NULL, CHANGE date_commande date_commande DATE NOT NULL, CHANGE etat etat INT NOT NULL');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67D82EA2E54 FOREIGN KEY (commande_id) REFERENCES utilisateur (id)');
        $this->addSql('CREATE INDEX IDX_6EEAA67D82EA2E54 ON commande (commande_id)');
        $this->addSql('ALTER TABLE detail ADD plat_id INT DEFAULT NULL, ADD detail_id INT DEFAULT NULL, ADD commande_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE detail ADD CONSTRAINT FK_2E067F93D73DB560 FOREIGN KEY (plat_id) REFERENCES plat (id)');
        $this->addSql('ALTER TABLE detail ADD CONSTRAINT FK_2E067F93D8D003BB FOREIGN KEY (detail_id) REFERENCES detail (id)');
        $this->addSql('ALTER TABLE detail ADD CONSTRAINT FK_2E067F9382EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id)');
        $this->addSql('CREATE INDEX IDX_2E067F93D73DB560 ON detail (plat_id)');
        $this->addSql('CREATE INDEX IDX_2E067F93D8D003BB ON detail (detail_id)');
        $this->addSql('CREATE INDEX IDX_2E067F9382EA2E54 ON detail (commande_id)');
        $this->addSql('ALTER TABLE plat ADD categorie_id INT DEFAULT NULL, DROP id_categorie, CHANGE libelle libelle VARCHAR(50) NOT NULL, CHANGE description description LONGTEXT NOT NULL, CHANGE prix prix NUMERIC(6, 2) NOT NULL, CHANGE image image VARCHAR(50) NOT NULL, CHANGE active active TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE plat ADD CONSTRAINT FK_2038A207BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)');
        $this->addSql('CREATE INDEX IDX_2038A207BCF5E72D ON plat (categorie_id)');
        $this->addSql('ALTER TABLE utilisateur ADD nom VARCHAR(50) NOT NULL, ADD prenom VARCHAR(50) NOT NULL, ADD telephone VARCHAR(20) NOT NULL, ADD adresse VARCHAR(50) NOT NULL, ADD cp VARCHAR(20) NOT NULL, ADD ville VARCHAR(50) NOT NULL, DROP nom_prenom, CHANGE email email VARCHAR(50) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE utilisateur ADD nom_prenom VARCHAR(100) NOT NULL, DROP nom, DROP prenom, DROP telephone, DROP adresse, DROP cp, DROP ville, CHANGE email email VARCHAR(100) NOT NULL');
        $this->addSql('ALTER TABLE plat DROP FOREIGN KEY FK_2038A207BCF5E72D');
        $this->addSql('DROP INDEX IDX_2038A207BCF5E72D ON plat');
        $this->addSql('ALTER TABLE plat ADD id_categorie INT NOT NULL, DROP categorie_id, CHANGE libelle libelle VARCHAR(100) NOT NULL, CHANGE description description TEXT NOT NULL, CHANGE prix prix NUMERIC(10, 2) NOT NULL, CHANGE image image VARCHAR(255) NOT NULL, CHANGE active active VARCHAR(10) NOT NULL');
        $this->addSql('ALTER TABLE categorie CHANGE libelle libelle VARCHAR(100) NOT NULL, CHANGE image image VARCHAR(255) NOT NULL, CHANGE active active VARCHAR(10) NOT NULL');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67D82EA2E54');
        $this->addSql('DROP INDEX IDX_6EEAA67D82EA2E54 ON commande');
        $this->addSql('ALTER TABLE commande ADD id_plat INT NOT NULL, ADD quantite INT NOT NULL, ADD nom_client VARCHAR(150) NOT NULL, ADD telephone_client VARCHAR(20) NOT NULL, ADD email_client VARCHAR(150) NOT NULL, ADD adresse_client VARCHAR(255) NOT NULL, DROP commande_id, CHANGE date_commande date_commande DATETIME NOT NULL, CHANGE total total NUMERIC(10, 2) NOT NULL, CHANGE etat etat VARCHAR(50) NOT NULL');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT commande_ibfk_1 FOREIGN KEY (id_plat) REFERENCES plat (id)');
        $this->addSql('CREATE INDEX id_plat ON commande (id_plat)');
        $this->addSql('ALTER TABLE detail DROP FOREIGN KEY FK_2E067F93D73DB560');
        $this->addSql('ALTER TABLE detail DROP FOREIGN KEY FK_2E067F93D8D003BB');
        $this->addSql('ALTER TABLE detail DROP FOREIGN KEY FK_2E067F9382EA2E54');
        $this->addSql('DROP INDEX IDX_2E067F93D73DB560 ON detail');
        $this->addSql('DROP INDEX IDX_2E067F93D8D003BB ON detail');
        $this->addSql('DROP INDEX IDX_2E067F9382EA2E54 ON detail');
        $this->addSql('ALTER TABLE detail DROP plat_id, DROP detail_id, DROP commande_id');
    }
}
