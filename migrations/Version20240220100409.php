<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240220100409 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE categorie DROP FOREIGN KEY FK_497DD634D73DB560');
        $this->addSql('DROP INDEX IDX_497DD634D73DB560 ON categorie');
        $this->addSql('ALTER TABLE categorie DROP plat_id');
        $this->addSql('ALTER TABLE commande ADD commande_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE commande ADD CONSTRAINT FK_6EEAA67D82EA2E54 FOREIGN KEY (commande_id) REFERENCES utilisateur (id)');
        $this->addSql('CREATE INDEX IDX_6EEAA67D82EA2E54 ON commande (commande_id)');
        $this->addSql('ALTER TABLE detail ADD plat_id INT DEFAULT NULL, ADD detail_id INT DEFAULT NULL, ADD commande_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE detail ADD CONSTRAINT FK_2E067F93D73DB560 FOREIGN KEY (plat_id) REFERENCES plat (id)');
        $this->addSql('ALTER TABLE detail ADD CONSTRAINT FK_2E067F93D8D003BB FOREIGN KEY (detail_id) REFERENCES detail (id)');
        $this->addSql('ALTER TABLE detail ADD CONSTRAINT FK_2E067F9382EA2E54 FOREIGN KEY (commande_id) REFERENCES commande (id)');
        $this->addSql('CREATE INDEX IDX_2E067F93D73DB560 ON detail (plat_id)');
        $this->addSql('CREATE INDEX IDX_2E067F93D8D003BB ON detail (detail_id)');
        $this->addSql('CREATE INDEX IDX_2E067F9382EA2E54 ON detail (commande_id)');
        $this->addSql('ALTER TABLE plat ADD categorie_id INT NOT NULL');
        $this->addSql('ALTER TABLE plat ADD CONSTRAINT FK_2038A207BCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)');
        $this->addSql('CREATE INDEX IDX_2038A207BCF5E72D ON plat (categorie_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE plat DROP FOREIGN KEY FK_2038A207BCF5E72D');
        $this->addSql('DROP INDEX IDX_2038A207BCF5E72D ON plat');
        $this->addSql('ALTER TABLE plat DROP categorie_id');
        $this->addSql('ALTER TABLE categorie ADD plat_id INT NOT NULL');
        $this->addSql('ALTER TABLE categorie ADD CONSTRAINT FK_497DD634D73DB560 FOREIGN KEY (plat_id) REFERENCES categorie (id)');
        $this->addSql('CREATE INDEX IDX_497DD634D73DB560 ON categorie (plat_id)');
        $this->addSql('ALTER TABLE commande DROP FOREIGN KEY FK_6EEAA67D82EA2E54');
        $this->addSql('DROP INDEX IDX_6EEAA67D82EA2E54 ON commande');
        $this->addSql('ALTER TABLE commande DROP commande_id');
        $this->addSql('ALTER TABLE detail DROP FOREIGN KEY FK_2E067F93D73DB560');
        $this->addSql('ALTER TABLE detail DROP FOREIGN KEY FK_2E067F93D8D003BB');
        $this->addSql('ALTER TABLE detail DROP FOREIGN KEY FK_2E067F9382EA2E54');
        $this->addSql('DROP INDEX IDX_2E067F93D73DB560 ON detail');
        $this->addSql('DROP INDEX IDX_2E067F93D8D003BB ON detail');
        $this->addSql('DROP INDEX IDX_2E067F9382EA2E54 ON detail');
        $this->addSql('ALTER TABLE detail DROP plat_id, DROP detail_id, DROP commande_id');
    }
}
