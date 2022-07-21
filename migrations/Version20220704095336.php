<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220704095336 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE distributeur (id INT AUTO_INCREMENT NOT NULL, nom_distributeur VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE produits_distributeur (produits_id INT NOT NULL, distributeur_id INT NOT NULL, INDEX IDX_9AEA45F3CD11A2CF (produits_id), INDEX IDX_9AEA45F329EB7ACA (distributeur_id), PRIMARY KEY(produits_id, distributeur_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE produits_distributeur ADD CONSTRAINT FK_9AEA45F3CD11A2CF FOREIGN KEY (produits_id) REFERENCES produits (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE produits_distributeur ADD CONSTRAINT FK_9AEA45F329EB7ACA FOREIGN KEY (distributeur_id) REFERENCES distributeur (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE produits ADD distributeur VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE produits_distributeur DROP FOREIGN KEY FK_9AEA45F329EB7ACA');
        $this->addSql('DROP TABLE distributeur');
        $this->addSql('DROP TABLE produits_distributeur');
        $this->addSql('ALTER TABLE produits DROP distributeur');
    }
}
