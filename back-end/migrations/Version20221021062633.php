<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221021062633 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user_match (id INT AUTO_INCREMENT NOT NULL, user_a_id INT NOT NULL, user_b_id INT NOT NULL, action VARCHAR(255) NOT NULL, INDEX IDX_98993E5D415F1F91 (user_a_id), INDEX IDX_98993E5D53EAB07F (user_b_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user_match ADD CONSTRAINT FK_98993E5D415F1F91 FOREIGN KEY (user_a_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE user_match ADD CONSTRAINT FK_98993E5D53EAB07F FOREIGN KEY (user_b_id) REFERENCES users (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user_match DROP FOREIGN KEY FK_98993E5D415F1F91');
        $this->addSql('ALTER TABLE user_match DROP FOREIGN KEY FK_98993E5D53EAB07F');
        $this->addSql('DROP TABLE user_match');
    }
}
