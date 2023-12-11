<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231211130937 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE dragon_treasure ALTER description TYPE VARCHAR(255)');
        $this->addSql('ALTER TABLE dragon_treasure ALTER description DROP NOT NULL');
        $this->addSql('ALTER TABLE dragon_treasure ALTER value DROP NOT NULL');
        $this->addSql('ALTER TABLE dragon_treasure ALTER cool_factor DROP NOT NULL');
        $this->addSql('ALTER TABLE dragon_treasure ALTER plunder_at DROP NOT NULL');
        $this->addSql('ALTER TABLE dragon_treasure ALTER is_published DROP NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE dragon_treasure ALTER description TYPE TEXT');
        $this->addSql('ALTER TABLE dragon_treasure ALTER description SET NOT NULL');
        $this->addSql('ALTER TABLE dragon_treasure ALTER value SET NOT NULL');
        $this->addSql('ALTER TABLE dragon_treasure ALTER cool_factor SET NOT NULL');
        $this->addSql('ALTER TABLE dragon_treasure ALTER plunder_at SET NOT NULL');
        $this->addSql('ALTER TABLE dragon_treasure ALTER is_published SET NOT NULL');
    }
}
