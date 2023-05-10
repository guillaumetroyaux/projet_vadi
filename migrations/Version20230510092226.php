<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230510092226 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE `like` (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, profil_id INT DEFAULT NULL, INDEX IDX_AC6340B3A76ED395 (user_id), INDEX IDX_AC6340B3275ED078 (profil_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE `like` ADD CONSTRAINT FK_AC6340B3A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE `like` ADD CONSTRAINT FK_AC6340B3275ED078 FOREIGN KEY (profil_id) REFERENCES profil (id)');
        $this->addSql('ALTER TABLE matches ADD profil1_id INT DEFAULT NULL, ADD profil2_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE matches ADD CONSTRAINT FK_62615BA88958A4D FOREIGN KEY (profil1_id) REFERENCES profil (id)');
        $this->addSql('ALTER TABLE matches ADD CONSTRAINT FK_62615BA9A2025A3 FOREIGN KEY (profil2_id) REFERENCES profil (id)');
        $this->addSql('CREATE INDEX IDX_62615BA88958A4D ON matches (profil1_id)');
        $this->addSql('CREATE INDEX IDX_62615BA9A2025A3 ON matches (profil2_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE `like` DROP FOREIGN KEY FK_AC6340B3A76ED395');
        $this->addSql('ALTER TABLE `like` DROP FOREIGN KEY FK_AC6340B3275ED078');
        $this->addSql('DROP TABLE `like`');
        $this->addSql('ALTER TABLE matches DROP FOREIGN KEY FK_62615BA88958A4D');
        $this->addSql('ALTER TABLE matches DROP FOREIGN KEY FK_62615BA9A2025A3');
        $this->addSql('DROP INDEX IDX_62615BA88958A4D ON matches');
        $this->addSql('DROP INDEX IDX_62615BA9A2025A3 ON matches');
        $this->addSql('ALTER TABLE matches DROP profil1_id, DROP profil2_id');
    }
}
