<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240908145446 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE fleet (id INT AUTO_INCREMENT NOT NULL, truck_id INT NOT NULL, trailer_id INT NOT NULL, UNIQUE INDEX UNIQ_A05E1E47C6957CCE (truck_id), UNIQUE INDEX UNIQ_A05E1E47B6C04CFD (trailer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `order` (id INT AUTO_INCREMENT NOT NULL, fleet_id INT DEFAULT NULL, truck_id INT DEFAULT NULL, trailer_id INT DEFAULT NULL, INDEX IDX_F5299398CA5B440D (fleet_id), INDEX IDX_F5299398FE9F2F8D (truck_id), INDEX IDX_F52993981CF5E7BC (trailer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE trailer (id INT AUTO_INCREMENT NOT NULL, license_number VARCHAR(20) NOT NULL, status VARCHAR(20) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE truck (id INT AUTO_INCREMENT NOT NULL, license_number VARCHAR(20) NOT NULL, status VARCHAR(20) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE fleet ADD CONSTRAINT FK_A05E1E47C6957CCE FOREIGN KEY (truck_id) REFERENCES truck (id)');
        $this->addSql('ALTER TABLE fleet ADD CONSTRAINT FK_A05E1E47B6C04CFD FOREIGN KEY (trailer_id) REFERENCES trailer (id)');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F5299398CA5B440D FOREIGN KEY (fleet_id) REFERENCES fleet (id)');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F5299398FE9F2F8D FOREIGN KEY (truck_id) REFERENCES truck (id)');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F52993981CF5E7BC FOREIGN KEY (trailer_id) REFERENCES trailer (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE fleet DROP FOREIGN KEY FK_A05E1E47C6957CCE');
        $this->addSql('ALTER TABLE fleet DROP FOREIGN KEY FK_A05E1E47B6C04CFD');
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F5299398CA5B440D');
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F5299398FE9F2F8D');
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F52993981CF5E7BC');
        $this->addSql('DROP TABLE fleet');
        $this->addSql('DROP TABLE `order`');
        $this->addSql('DROP TABLE trailer');
        $this->addSql('DROP TABLE truck');
    }
}
