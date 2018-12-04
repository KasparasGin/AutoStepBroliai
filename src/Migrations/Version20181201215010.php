<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181201215010 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE car (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, brand VARCHAR(255) NOT NULL, model VARCHAR(255) NOT NULL, year VARCHAR(255) NOT NULL, gearbox VARCHAR(255) NOT NULL, fuel_type VARCHAR(255) NOT NULL, registration_plate VARCHAR(190) NOT NULL, UNIQUE INDEX UNIQ_773DE69DFE3477B3 (registration_plate), INDEX IDX_773DE69DA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE visit (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, car_id INT NOT NULL, date DATE NOT NULL, time TIME NOT NULL, description LONGTEXT DEFAULT NULL, INDEX IDX_437EE939A76ED395 (user_id), INDEX IDX_437EE939C3C6F69F (car_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE car ADD CONSTRAINT FK_773DE69DA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE visit ADD CONSTRAINT FK_437EE939A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE visit ADD CONSTRAINT FK_437EE939C3C6F69F FOREIGN KEY (car_id) REFERENCES car (id)');
        $this->addSql('CREATE TABLE supplier (id INT AUTO_INCREMENT NOT NULL, company_code VARCHAR(255) NOT NULL, name VARCHAR(255) NOT NULL, address VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE visit DROP FOREIGN KEY FK_437EE939C3C6F69F');
        $this->addSql('DROP TABLE car');
        $this->addSql('DROP TABLE visit');
        $this->addSql('DROP TABLE supplier');
    }
}
