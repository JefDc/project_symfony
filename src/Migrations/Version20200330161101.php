<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200330161101 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE spec (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE spec_property (spec_id INT NOT NULL, property_id INT NOT NULL, INDEX IDX_74681F25AA8FA4FB (spec_id), INDEX IDX_74681F25549213EC (property_id), PRIMARY KEY(spec_id, property_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE spec_property ADD CONSTRAINT FK_74681F25AA8FA4FB FOREIGN KEY (spec_id) REFERENCES spec (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE spec_property ADD CONSTRAINT FK_74681F25549213EC FOREIGN KEY (property_id) REFERENCES property (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE spec_property DROP FOREIGN KEY FK_74681F25AA8FA4FB');
        $this->addSql('DROP TABLE spec');
        $this->addSql('DROP TABLE spec_property');
    }
}
