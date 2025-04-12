<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250111221516 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE booking ADD restaurant_id INT NOT NULL');
        $this->addSql('ALTER TABLE booking ADD CONSTRAINT FK_E00CEDDEB1E7706E FOREIGN KEY (restaurant_id) REFERENCES restaurant (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_E00CEDDEB1E7706E ON booking (restaurant_id)');
        $this->addSql('ALTER TABLE food_category ADD category_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE food_category ADD food_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE food_category ADD CONSTRAINT FK_2E013E8312469DE2 FOREIGN KEY (category_id) REFERENCES category (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE food_category ADD CONSTRAINT FK_2E013E83BA8E87C4 FOREIGN KEY (food_id) REFERENCES food (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_2E013E8312469DE2 ON food_category (category_id)');
        $this->addSql('CREATE INDEX IDX_2E013E83BA8E87C4 ON food_category (food_id)');
        $this->addSql('ALTER TABLE menu ADD restaurant_id INT NOT NULL');
        $this->addSql('ALTER TABLE menu ADD CONSTRAINT FK_7D053A93B1E7706E FOREIGN KEY (restaurant_id) REFERENCES restaurant (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_7D053A93B1E7706E ON menu (restaurant_id)');
        $this->addSql('ALTER TABLE menu_category ADD menu_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE menu_category ADD category_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE menu_category ADD CONSTRAINT FK_2A1D5C57CCD7E912 FOREIGN KEY (menu_id) REFERENCES menu (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE menu_category ADD CONSTRAINT FK_2A1D5C5712469DE2 FOREIGN KEY (category_id) REFERENCES category (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_2A1D5C57CCD7E912 ON menu_category (menu_id)');
        $this->addSql('CREATE INDEX IDX_2A1D5C5712469DE2 ON menu_category (category_id)');
        $this->addSql('ALTER TABLE picture ADD restaurant_id INT NOT NULL');
        $this->addSql('ALTER TABLE picture ADD CONSTRAINT FK_16DB4F89B1E7706E FOREIGN KEY (restaurant_id) REFERENCES restaurant (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_16DB4F89B1E7706E ON picture (restaurant_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE picture DROP CONSTRAINT FK_16DB4F89B1E7706E');
        $this->addSql('DROP INDEX IDX_16DB4F89B1E7706E');
        $this->addSql('ALTER TABLE picture DROP restaurant_id');
        $this->addSql('ALTER TABLE menu_category DROP CONSTRAINT FK_2A1D5C57CCD7E912');
        $this->addSql('ALTER TABLE menu_category DROP CONSTRAINT FK_2A1D5C5712469DE2');
        $this->addSql('DROP INDEX IDX_2A1D5C57CCD7E912');
        $this->addSql('DROP INDEX IDX_2A1D5C5712469DE2');
        $this->addSql('ALTER TABLE menu_category DROP menu_id');
        $this->addSql('ALTER TABLE menu_category DROP category_id');
        $this->addSql('ALTER TABLE menu DROP CONSTRAINT FK_7D053A93B1E7706E');
        $this->addSql('DROP INDEX IDX_7D053A93B1E7706E');
        $this->addSql('ALTER TABLE menu DROP restaurant_id');
        $this->addSql('ALTER TABLE booking DROP CONSTRAINT FK_E00CEDDEB1E7706E');
        $this->addSql('DROP INDEX IDX_E00CEDDEB1E7706E');
        $this->addSql('ALTER TABLE booking DROP restaurant_id');
        $this->addSql('ALTER TABLE food_category DROP CONSTRAINT FK_2E013E8312469DE2');
        $this->addSql('ALTER TABLE food_category DROP CONSTRAINT FK_2E013E83BA8E87C4');
        $this->addSql('DROP INDEX IDX_2E013E8312469DE2');
        $this->addSql('DROP INDEX IDX_2E013E83BA8E87C4');
        $this->addSql('ALTER TABLE food_category DROP category_id');
        $this->addSql('ALTER TABLE food_category DROP food_id');
    }
}
