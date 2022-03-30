<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220323135602 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE salaire ADD valeur VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE gr_user ADD CONSTRAINT FK_830350902678C781 FOREIGN KEY (salaire_id) REFERENCES salaire (id)');
        $this->addSql('ALTER TABLE gr_user ADD CONSTRAINT FK_8303509057889920 FOREIGN KEY (fonction_id) REFERENCES fonction (id)');
        $this->addSql('CREATE INDEX IDX_830350902678C781 ON gr_user (salaire_id)');
        $this->addSql('CREATE INDEX IDX_8303509057889920 ON gr_user (fonction_id)');

    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE fonction CHANGE fonction_name fonction_name VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE fonction_description fonction_description VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE gr_user DROP FOREIGN KEY FK_830350902678C781');
        $this->addSql('ALTER TABLE gr_user DROP FOREIGN KEY FK_8303509057889920');
        $this->addSql('DROP INDEX IDX_830350902678C781 ON gr_user');
        $this->addSql('DROP INDEX IDX_8303509057889920 ON gr_user');
        $this->addSql('ALTER TABLE gr_user CHANGE email email VARCHAR(180) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE password password VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE full_name full_name VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE salaire DROP valeur');
    }
}
