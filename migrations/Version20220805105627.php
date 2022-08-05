<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220805105627 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE cocktails_ingredients (cocktails_id INT NOT NULL, ingredients_id INT NOT NULL, INDEX IDX_A3A9C46095BBB5D6 (cocktails_id), INDEX IDX_A3A9C4603EC4DCE (ingredients_id), PRIMARY KEY(cocktails_id, ingredients_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mocktails_category (mocktails_id INT NOT NULL, category_id INT NOT NULL, INDEX IDX_56376D327C8A66C8 (mocktails_id), INDEX IDX_56376D3212469DE2 (category_id), PRIMARY KEY(mocktails_id, category_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE mocktails_ingredients (mocktails_id INT NOT NULL, ingredients_id INT NOT NULL, INDEX IDX_7066C8D07C8A66C8 (mocktails_id), INDEX IDX_7066C8D03EC4DCE (ingredients_id), PRIMARY KEY(mocktails_id, ingredients_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cocktails_ingredients ADD CONSTRAINT FK_A3A9C46095BBB5D6 FOREIGN KEY (cocktails_id) REFERENCES cocktails (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE cocktails_ingredients ADD CONSTRAINT FK_A3A9C4603EC4DCE FOREIGN KEY (ingredients_id) REFERENCES ingredients (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE mocktails_category ADD CONSTRAINT FK_56376D327C8A66C8 FOREIGN KEY (mocktails_id) REFERENCES mocktails (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE mocktails_category ADD CONSTRAINT FK_56376D3212469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE mocktails_ingredients ADD CONSTRAINT FK_7066C8D07C8A66C8 FOREIGN KEY (mocktails_id) REFERENCES mocktails (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE mocktails_ingredients ADD CONSTRAINT FK_7066C8D03EC4DCE FOREIGN KEY (ingredients_id) REFERENCES ingredients (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE cocktails DROP ingredients');
        $this->addSql('ALTER TABLE ingredients ADD ingredients VARCHAR(255) NOT NULL, ADD quantite VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE mocktails DROP FOREIGN KEY FK_52094B4012469DE2');
        $this->addSql('DROP INDEX IDX_52094B4012469DE2 ON mocktails');
        $this->addSql('ALTER TABLE mocktails DROP category_id, DROP ingredients');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE cocktails_ingredients');
        $this->addSql('DROP TABLE mocktails_category');
        $this->addSql('DROP TABLE mocktails_ingredients');
        $this->addSql('ALTER TABLE cocktails ADD ingredients VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE ingredients DROP ingredients, DROP quantite');
        $this->addSql('ALTER TABLE mocktails ADD category_id INT DEFAULT NULL, ADD ingredients LONGTEXT NOT NULL');
        $this->addSql('ALTER TABLE mocktails ADD CONSTRAINT FK_52094B4012469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('CREATE INDEX IDX_52094B4012469DE2 ON mocktails (category_id)');
    }
}
