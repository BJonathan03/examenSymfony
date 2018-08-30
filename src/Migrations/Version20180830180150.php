<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20180830180150 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        //$this->addSql('CREATE TABLE cocktails (id INT AUTO_INCREMENT NOT NULL, categories_id INT NOT NULL, nom VARCHAR(100) NOT NULL, description LONGTEXT DEFAULT NULL, prix INT DEFAULT NULL, volume INT DEFAULT NULL, origine VARCHAR(45) DEFAULT NULL, image_url VARCHAR(100) DEFAULT NULL, INDEX IDX_9ACB90D2A21214B7 (categories_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
       // $this->addSql('CREATE TABLE categories (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(128) NOT NULL, description VARCHAR(45) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ingredients (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(45) NOT NULL, description VARCHAR(45) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ingredients_cocktails (ingredients_id INT NOT NULL, cocktails_id INT NOT NULL, INDEX IDX_95BABAE83EC4DCE (ingredients_id), INDEX IDX_95BABAE895BBB5D6 (cocktails_id), PRIMARY KEY(ingredients_id, cocktails_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        //$this->addSql('ALTER TABLE cocktails ADD CONSTRAINT FK_9ACB90D2A21214B7 FOREIGN KEY (categories_id) REFERENCES categories (id)');
        $this->addSql('ALTER TABLE ingredients_cocktails ADD CONSTRAINT FK_95BABAE83EC4DCE FOREIGN KEY (ingredients_id) REFERENCES ingredients (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ingredients_cocktails ADD CONSTRAINT FK_95BABAE895BBB5D6 FOREIGN KEY (cocktails_id) REFERENCES cocktails (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE ingredients_cocktails DROP FOREIGN KEY FK_95BABAE895BBB5D6');
        $this->addSql('ALTER TABLE cocktails DROP FOREIGN KEY FK_9ACB90D2A21214B7');
        $this->addSql('ALTER TABLE ingredients_cocktails DROP FOREIGN KEY FK_95BABAE83EC4DCE');
        $this->addSql('DROP TABLE cocktails');
        $this->addSql('DROP TABLE categories');
        $this->addSql('DROP TABLE ingredients');
        $this->addSql('DROP TABLE ingredients_cocktails');
    }
}
