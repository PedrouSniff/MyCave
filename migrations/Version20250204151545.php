<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250204151545 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE caves_vins ADD vins_id INT DEFAULT NULL, ADD caves_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE caves_vins ADD CONSTRAINT FK_2D26F782FBA7BE81 FOREIGN KEY (vins_id) REFERENCES vins (id)');
        $this->addSql('ALTER TABLE caves_vins ADD CONSTRAINT FK_2D26F7827AA43AD1 FOREIGN KEY (caves_id) REFERENCES caves (id)');
        $this->addSql('CREATE INDEX IDX_2D26F782FBA7BE81 ON caves_vins (vins_id)');
        $this->addSql('CREATE INDEX IDX_2D26F7827AA43AD1 ON caves_vins (caves_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE caves_vins DROP FOREIGN KEY FK_2D26F782FBA7BE81');
        $this->addSql('ALTER TABLE caves_vins DROP FOREIGN KEY FK_2D26F7827AA43AD1');
        $this->addSql('DROP INDEX IDX_2D26F782FBA7BE81 ON caves_vins');
        $this->addSql('DROP INDEX IDX_2D26F7827AA43AD1 ON caves_vins');
        $this->addSql('ALTER TABLE caves_vins DROP vins_id, DROP caves_id');
    }
}
