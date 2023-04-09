<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230409140317 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE conversation_profil DROP FOREIGN KEY FK_D41A0857275ED078');
        $this->addSql('ALTER TABLE conversation_profil DROP FOREIGN KEY FK_D41A08579AC0396');
        $this->addSql('DROP TABLE conversation_profil');
        $this->addSql('ALTER TABLE profil ADD id_user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE profil ADD CONSTRAINT FK_E6D6B29779F37AE5 FOREIGN KEY (id_user_id) REFERENCES user (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_E6D6B29779F37AE5 ON profil (id_user_id)');
        $this->addSql('ALTER TABLE user ADD id_profil_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649A76B6C5F FOREIGN KEY (id_profil_id) REFERENCES profil (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649A76B6C5F ON user (id_profil_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE conversation_profil (conversation_id INT NOT NULL, profil_id INT NOT NULL, INDEX IDX_D41A08579AC0396 (conversation_id), INDEX IDX_D41A0857275ED078 (profil_id), PRIMARY KEY(conversation_id, profil_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE conversation_profil ADD CONSTRAINT FK_D41A0857275ED078 FOREIGN KEY (profil_id) REFERENCES profil (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE conversation_profil ADD CONSTRAINT FK_D41A08579AC0396 FOREIGN KEY (conversation_id) REFERENCES conversation (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE profil DROP FOREIGN KEY FK_E6D6B29779F37AE5');
        $this->addSql('DROP INDEX UNIQ_E6D6B29779F37AE5 ON profil');
        $this->addSql('ALTER TABLE profil DROP id_user_id');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649A76B6C5F');
        $this->addSql('DROP INDEX UNIQ_8D93D649A76B6C5F ON user');
        $this->addSql('ALTER TABLE user DROP id_profil_id');
    }
}
