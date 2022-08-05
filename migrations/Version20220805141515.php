<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220805141515 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE page_mocktail DROP FOREIGN KEY FK_EE5C01C612469DE2');
        $this->addSql('DROP INDEX IDX_EE5C01C612469DE2 ON page_mocktail');
        $this->addSql('ALTER TABLE page_mocktail DROP category_id, DROP preparation, DROP titre, DROP ingredients');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE page_mocktail ADD category_id INT DEFAULT NULL, ADD preparation LONGTEXT NOT NULL, ADD titre VARCHAR(255) NOT NULL, ADD ingredients LONGTEXT NOT NULL');
        $this->addSql('ALTER TABLE page_mocktail ADD CONSTRAINT FK_EE5C01C612469DE2 FOREIGN KEY (category_id) REFERENCES page_category (id)');
        $this->addSql('CREATE INDEX IDX_EE5C01C612469DE2 ON page_mocktail (category_id)');
    }
}
