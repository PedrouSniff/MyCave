<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250204151954 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE raisins_vins ADD vins_id INT DEFAULT NULL, ADD raisins_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE raisins_vins ADD CONSTRAINT FK_DEDA824BFBA7BE81 FOREIGN KEY (vins_id) REFERENCES vins (id)');
        $this->addSql('ALTER TABLE raisins_vins ADD CONSTRAINT FK_DEDA824BA1795DFC FOREIGN KEY (raisins_id) REFERENCES raisins (id)');
        $this->addSql('CREATE INDEX IDX_DEDA824BFBA7BE81 ON raisins_vins (vins_id)');
        $this->addSql('CREATE INDEX IDX_DEDA824BA1795DFC ON raisins_vins (raisins_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE raisins_vins DROP FOREIGN KEY FK_DEDA824BFBA7BE81');
        $this->addSql('ALTER TABLE raisins_vins DROP FOREIGN KEY FK_DEDA824BA1795DFC');
        $this->addSql('DROP INDEX IDX_DEDA824BFBA7BE81 ON raisins_vins');
        $this->addSql('DROP INDEX IDX_DEDA824BA1795DFC ON raisins_vins');
        $this->addSql('ALTER TABLE raisins_vins DROP vins_id, DROP raisins_id');
    }
}
