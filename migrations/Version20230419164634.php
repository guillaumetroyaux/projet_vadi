<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230419164634 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE photo_profil ADD profil_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE photo_profil ADD CONSTRAINT FK_B369C5BF275ED078 FOREIGN KEY (profil_id) REFERENCES profil (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_B369C5BF275ED078 ON photo_profil (profil_id)');
        $this->addSql('ALTER TABLE profil ADD photo_profil_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE profil ADD CONSTRAINT FK_E6D6B2972AA08659 FOREIGN KEY (photo_profil_id) REFERENCES photo_profil (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_E6D6B2972AA08659 ON profil (photo_profil_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE photo_profil DROP FOREIGN KEY FK_B369C5BF275ED078');
        $this->addSql('DROP INDEX UNIQ_B369C5BF275ED078 ON photo_profil');
        $this->addSql('ALTER TABLE photo_profil DROP profil_id');
        $this->addSql('ALTER TABLE profil DROP FOREIGN KEY FK_E6D6B2972AA08659');
        $this->addSql('DROP INDEX UNIQ_E6D6B2972AA08659 ON profil');
        $this->addSql('ALTER TABLE profil DROP photo_profil_id');
    }
}
