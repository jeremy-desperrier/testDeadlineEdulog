<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220312200230 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE deadline (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, due_date DATETIME NOT NULL, is_done TINYINT(1) DEFAULT 0 NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql("INSERT INTO `deadline` (`id`, `title`, `due_date`, `is_done`)
VALUES
	(1,'Rendu de l\'appel d\'offre','2022-02-28',0),
	(2,'Livraison du développement pour le lycée A','2022-03-01',1),
	(3,'Réunion de lancement projet','2022-02-28',0),
	(4,'Réunion de suivi mensuelle','2022-02-25',0),
	(5,'Livraison version 2.4.3','2022-02-24',0),
	(6,'Installation serveur CFA B','2022-03-01',0),
	(7,'Réunion commerciale avec collège C','2022-03-02',0),
	(8,'Evénement de dissémination Erasmus+','2022-03-22',0),
	(9,'Entretien CE lycée D','2022-03-24',0),
	(10,'Démonstration des fonctionnalités Ensemble scolaire E','2022-03-03',0),
	(11,'Webinar de présentation logiciel','2022-03-16',0),
	(12,'Installation évolution lycée A','2022-03-08',0),
	(13,'Communication du test technique','2022-02-23',1);");
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE deadline');
    }
}
