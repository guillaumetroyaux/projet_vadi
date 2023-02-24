<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230224135650 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE conversation_profil (conversation_id INT NOT NULL, profil_id INT NOT NULL, INDEX IDX_D41A08579AC0396 (conversation_id), INDEX IDX_D41A0857275ED078 (profil_id), PRIMARY KEY(conversation_id, profil_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE conversation_profil ADD CONSTRAINT FK_D41A08579AC0396 FOREIGN KEY (conversation_id) REFERENCES conversation (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE conversation_profil ADD CONSTRAINT FK_D41A0857275ED078 FOREIGN KEY (profil_id) REFERENCES profil (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE conversation_profil DROP FOREIGN KEY FK_D41A08579AC0396');
        $this->addSql('ALTER TABLE conversation_profil DROP FOREIGN KEY FK_D41A0857275ED078');
        $this->addSql('DROP TABLE conversation_profil');
    }
}
