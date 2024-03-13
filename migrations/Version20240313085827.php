<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240313085827 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user_order_item (id INT AUTO_INCREMENT NOT NULL, user_order_id INT NOT NULL, item_price INT NOT NULL, INDEX IDX_F58DD9E56D128938 (user_order_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE user_order_item ADD CONSTRAINT FK_F58DD9E56D128938 FOREIGN KEY (user_order_id) REFERENCES user_order (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user_order_item DROP FOREIGN KEY FK_F58DD9E56D128938');
        $this->addSql('DROP TABLE user_order_item');
    }
}
