<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230428124928 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE matches_profil (matches_id INT NOT NULL, profil_id INT NOT NULL, INDEX IDX_A31153AA4B30DD19 (matches_id), INDEX IDX_A31153AA275ED078 (profil_id), PRIMARY KEY(matches_id, profil_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE matches_profil ADD CONSTRAINT FK_A31153AA4B30DD19 FOREIGN KEY (matches_id) REFERENCES matches (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE matches_profil ADD CONSTRAINT FK_A31153AA275ED078 FOREIGN KEY (profil_id) REFERENCES profil (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE matches_profil DROP FOREIGN KEY FK_A31153AA4B30DD19');
        $this->addSql('ALTER TABLE matches_profil DROP FOREIGN KEY FK_A31153AA275ED078');
        $this->addSql('DROP TABLE matches_profil');
    }
}
