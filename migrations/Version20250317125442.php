<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250317125442 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE club_winner (club_id INT NOT NULL, winner_id INT NOT NULL, INDEX IDX_2939DC8461190A32 (club_id), INDEX IDX_2939DC845DFCD4B8 (winner_id), PRIMARY KEY(club_id, winner_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE club_winner ADD CONSTRAINT FK_2939DC8461190A32 FOREIGN KEY (club_id) REFERENCES club (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE club_winner ADD CONSTRAINT FK_2939DC845DFCD4B8 FOREIGN KEY (winner_id) REFERENCES winner (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE winner ADD winners INT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE club_winner DROP FOREIGN KEY FK_2939DC8461190A32');
        $this->addSql('ALTER TABLE club_winner DROP FOREIGN KEY FK_2939DC845DFCD4B8');
        $this->addSql('DROP TABLE club_winner');
        $this->addSql('ALTER TABLE winner DROP winners');
    }
}
