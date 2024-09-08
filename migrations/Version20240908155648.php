<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240908155648 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `order` ADD status VARCHAR(20) NOT NULL');
        $this->addSql('ALTER TABLE `fleet` ADD status VARCHAR(20) NOT NULL');

        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F5299398FE9F2F8D');
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F52993981CF5E7BC');
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F5299398CA5B440D');
        $this->addSql('DROP INDEX IDX_F5299398CA5B440D ON `order`');
        $this->addSql('DROP INDEX IDX_F5299398FE9F2F8D ON `order`');
        $this->addSql('DROP INDEX IDX_F52993981CF5E7BC ON `order`');
        $this->addSql('ALTER TABLE `order` ADD fleet_id INT DEFAULT NULL, ADD truck_id INT DEFAULT NULL, ADD trailer_id INT DEFAULT NULL, ADD created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', DROP fleet_id, DROP truck_id, DROP trailer_id');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F5299398FE9F2F8D FOREIGN KEY (truck_id) REFERENCES truck (id)');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F52993981CF5E7BC FOREIGN KEY (trailer_id) REFERENCES trailer (id)');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F5299398CA5B440D FOREIGN KEY (fleet_id) REFERENCES fleet (id)');
        $this->addSql('CREATE INDEX IDX_F5299398CA5B440D ON `order` (fleet_id)');
        $this->addSql('CREATE INDEX IDX_F5299398FE9F2F8D ON `order` (truck_id)');
        $this->addSql('CREATE INDEX IDX_F52993981CF5E7BC ON `order` (trailer_id)');
        $this->addSql("
            INSERT INTO truck (license_number, status) VALUES
            ('TRUCK001', 'WORKS'),
            ('TRUCK002', 'FREE'),
            ('TRUCK003', 'DOWNTIME'),
            ('TRUCK004', 'WORKS'),
            ('TRUCK005', 'FREE'),
            ('TRUCK006', 'DOWNTIME'),
            ('TRUCK007', 'WORKS'),
            ('TRUCK008', 'FREE'),
            ('TRUCK009', 'DOWNTIME'),
            ('TRUCK010', 'WORKS'),
            ('TRUCK011', 'FREE'),  -- Additional truck not in fleet set
            ('TRUCK012', 'DOWNTIME'),  -- Additional truck not in fleet set
            ('TRUCK013', 'WORKS');  -- Additional truck not in fleet set
        ");

        // Insert trailers
        $this->addSql("
            INSERT INTO trailer (license_number, status) VALUES
            ('TRAILER001', 'WORKS'),
            ('TRAILER002', 'FREE'),
            ('TRAILER003', 'DOWNTIME'),
            ('TRAILER004', 'WORKS'),
            ('TRAILER005', 'FREE'),
            ('TRAILER006', 'DOWNTIME'),
            ('TRAILER007', 'WORKS'),
            ('TRAILER008', 'FREE'),
            ('TRAILER009', 'DOWNTIME'),
            ('TRAILER010', 'WORKS'),
            ('TRAILER011', 'FREE'),
            ('TRAILER012', 'DOWNTIME'),
            ('TRAILER013', 'WORKS');
        ");

        // Insert fleet sets (combining trucks and trailers)
        $this->addSql("
            INSERT INTO fleet (truck_id, trailer_id, status) VALUES
            (1, 1, 'WORKS'),
            (2, 2, 'FREE'),
            (3, 3, 'DOWNTIME'),
            (4, 4, 'WORKS'),
            (5, 5, 'FREE'),
            (6, 6, 'DOWNTIME'),
            (7, 7, 'WORKS'),
            (8, 8, 'FREE'),
            (9, 9, 'DOWNTIME'),
            (10, 10, 'WORKS');
        ");

        // Insert service orders with truck_id, trailer_id, and fleet_set_id
        $this->addSql("
            INSERT INTO `order` (`truck_id`, `trailer_id`, `fleet_id`, `status`, `created_at`) VALUES
            (NULL, NULL, 1, 'PENDING', '2024-09-07 08:00:00'),
            (NULL, NULL, 2, 'IN_PROGRESS', '2024-09-07 09:00:00'),
            (NULL, NULL, 3, 'COMPLETED', '2024-09-06 10:00:00'),
            (NULL, NULL, 4, 'PENDING', '2024-09-05 11:00:00'),
            (NULL, NULL, 5, 'IN_PROGRESS', '2024-09-05 12:00:00'),
            (NULL, NULL, 6, 'COMPLETED', '2024-09-04 13:00:00'),
            (NULL, NULL, 7, 'PENDING', '2024-09-03 14:00:00'),
            (NULL, NULL, 8, 'IN_PROGRESS', '2024-09-02 15:00:00'),
            (NULL, NULL, 9, 'COMPLETED', '2024-09-01 16:00:00'),
            (NULL, NULL, 10, 'PENDING', '2024-08-31 17:00:00'),
            (13, 13, NULL, 'PENDING', '2024-08-31 17:00:00');

        ");

    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F5299398CA5B440D');
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F5299398FE9F2F8D');
        $this->addSql('ALTER TABLE `order` DROP FOREIGN KEY FK_F52993981CF5E7BC');
        $this->addSql('DROP INDEX IDX_F5299398CA5B440D ON `order`');
        $this->addSql('DROP INDEX IDX_F5299398FE9F2F8D ON `order`');
        $this->addSql('DROP INDEX IDX_F52993981CF5E7BC ON `order`');
        $this->addSql('ALTER TABLE `order` ADD fleet_id INT DEFAULT NULL, ADD truck_id INT DEFAULT NULL, ADD trailer_id INT DEFAULT NULL, DROP fleet_id, DROP truck_id, DROP trailer_id, DROP created_at');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F5299398CA5B440D FOREIGN KEY (fleet_id) REFERENCES fleet (id)');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F5299398FE9F2F8D FOREIGN KEY (truck_id) REFERENCES truck (id)');
        $this->addSql('ALTER TABLE `order` ADD CONSTRAINT FK_F52993981CF5E7BC FOREIGN KEY (trailer_id) REFERENCES trailer (id)');
        $this->addSql('CREATE INDEX IDX_F5299398CA5B440D ON `order` (fleet_id)');
        $this->addSql('CREATE INDEX IDX_F5299398FE9F2F8D ON `order` (truck_id)');
        $this->addSql('CREATE INDEX IDX_F52993981CF5E7BC ON `order` (trailer_id)');
        $this->addSql('ALTER TABLE fleet DROP status');
        $this->addSql('DELETE FROM order');
        $this->addSql('DELETE FROM fleet');
        $this->addSql('DELETE FROM truck');
        $this->addSql('DELETE FROM trailer');
    }
}
