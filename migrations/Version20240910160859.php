<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240910160859 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE history (id INT AUTO_INCREMENT NOT NULL, order_id INT NOT NULL, status VARCHAR(20) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_27BA704BFCDAEAAA (order_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE history ADD CONSTRAINT FK_27BA704BFCDAEAAA FOREIGN KEY (order_id) REFERENCES `order` (id)');
        $this->addSql('ALTER TABLE `order` CHANGE status status VARCHAR(255) NOT NULL');
        $this->addSql("
            INSERT INTO history (order_id, status, created_at) VALUES
            (1, 'PENDING', '2024-09-07 08:00:00'),
            (1, 'IN_PROGRESS', '2024-09-07 10:00:00'),
            (1, 'COMPLETED', '2024-09-07 14:00:00'),

            (2, 'PENDING', '2024-09-06 09:00:00'),
            (2, 'IN_PROGRESS', '2024-09-07 09:00:00'),
            (2, 'COMPLETED', '2024-09-08 10:00:00'),

            (3, 'PENDING', '2024-09-05 10:00:00'),
            (3, 'IN_PROGRESS', '2024-09-06 11:00:00'),
            (3, 'COMPLETED', '2024-09-06 15:00:00'),

            (4, 'PENDING', '2024-09-04 08:00:00'),
            (4, 'IN_PROGRESS', '2024-09-05 09:30:00'),
            (4, 'COMPLETED', '2024-09-05 17:00:00'),

            (5, 'PENDING', '2024-09-03 12:00:00'),
            (5, 'IN_PROGRESS', '2024-09-04 13:00:00'),
            (5, 'COMPLETED', '2024-09-05 16:00:00'),

            (6, 'PENDING', '2024-09-02 09:00:00'),
            (6, 'IN_PROGRESS', '2024-09-03 10:30:00'),
            (6, 'COMPLETED', '2024-09-03 15:30:00'),

            (7, 'PENDING', '2024-09-01 14:00:00'),
            (7, 'IN_PROGRESS', '2024-09-02 08:30:00'),
            (7, 'COMPLETED', '2024-09-02 12:30:00'),

            (8, 'PENDING', '2024-08-31 16:00:00'),
            (8, 'IN_PROGRESS', '2024-09-01 09:00:00'),
            (8, 'COMPLETED', '2024-09-01 13:00:00'),

            (9, 'PENDING', '2024-08-30 08:30:00'),
            (9, 'IN_PROGRESS', '2024-08-30 12:00:00'),
            (9, 'COMPLETED', '2024-08-30 18:00:00'),

            (10, 'PENDING', '2024-08-29 09:00:00'),
            (10, 'IN_PROGRESS', '2024-08-30 10:00:00'),
            (10, 'COMPLETED', '2024-08-30 14:00:00');
        ");
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE history DROP FOREIGN KEY FK_27BA704BFCDAEAAA');
        $this->addSql('DROP TABLE history');
        $this->addSql('ALTER TABLE `order` CHANGE status status VARCHAR(20) NOT NULL');
    }
}
