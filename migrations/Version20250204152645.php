<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250204152645 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE region ADD pays_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE region ADD CONSTRAINT FK_F62F176A6E44244 FOREIGN KEY (pays_id) REFERENCES pays (id)');
        $this->addSql('CREATE INDEX IDX_F62F176A6E44244 ON region (pays_id)');
        $this->addSql('ALTER TABLE vins ADD region_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE vins ADD CONSTRAINT FK_1A64B65C98260155 FOREIGN KEY (region_id) REFERENCES region (id)');
        $this->addSql('CREATE INDEX IDX_1A64B65C98260155 ON vins (region_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE vins DROP FOREIGN KEY FK_1A64B65C98260155');
        $this->addSql('DROP INDEX IDX_1A64B65C98260155 ON vins');
        $this->addSql('ALTER TABLE vins DROP region_id');
        $this->addSql('ALTER TABLE region DROP FOREIGN KEY FK_F62F176A6E44244');
        $this->addSql('DROP INDEX IDX_F62F176A6E44244 ON region');
        $this->addSql('ALTER TABLE region DROP pays_id');
    }
}
