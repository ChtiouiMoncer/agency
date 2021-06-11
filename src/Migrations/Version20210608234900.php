<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210608234900 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE patient_informations (id INT AUTO_INCREMENT NOT NULL, specialisation_id INT DEFAULT NULL, tourisme_region_id INT DEFAULT NULL, housing_id INT DEFAULT NULL, patient_folder_id INT DEFAULT NULL, patient_doctor_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, age INT DEFAULT NULL, sexe VARCHAR(50) DEFAULT NULL, country VARCHAR(255) NOT NULL, phone INT NOT NULL, email VARCHAR(50) NOT NULL, demande LONGTEXT NOT NULL, is_approved TINYINT(1) NOT NULL, is_rejected TINYINT(1) NOT NULL, email_comfired TINYINT(1) NOT NULL, report LONGTEXT DEFAULT NULL, informations_confirmed TINYINT(1) NOT NULL, report_done TINYINT(1) NOT NULL, patient_confirmed TINYINT(1) NOT NULL, patient_not_confirmed TINYINT(1) NOT NULL, invoice_sent TINYINT(1) NOT NULL, INDEX IDX_89C53BB75627D44C (specialisation_id), INDEX IDX_89C53BB79FA2126B (tourisme_region_id), INDEX IDX_89C53BB7AD5873E3 (housing_id), UNIQUE INDEX UNIQ_89C53BB7B0A76B7D (patient_folder_id), INDEX IDX_89C53BB7217F2928 (patient_doctor_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE medical_files (id INT AUTO_INCREMENT NOT NULL, qte_smoking_id INT DEFAULT NULL, qtealcohol_id INT DEFAULT NULL, medical_file_name VARCHAR(255) NOT NULL, upload_at DATETIME NOT NULL, weight INT NOT NULL, size INT NOT NULL, is_smoking TINYINT(1) NOT NULL, is_alcohloic TINYINT(1) NOT NULL, health_info LONGTEXT NOT NULL, is_approved TINYINT(1) NOT NULL, is_rejected TINYINT(1) NOT NULL, email_confirmed TINYINT(1) NOT NULL, INDEX IDX_33D31B098101B95A (qte_smoking_id), INDEX IDX_33D31B09DE04DCEA (qtealcohol_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE users (id INT AUTO_INCREMENT NOT NULL, spec_id INT DEFAULT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, user_name VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_1483A5E9E7927C74 (email), INDEX IDX_1483A5E9AA8FA4FB (spec_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE alcohol_qte (id INT AUTO_INCREMENT NOT NULL, qte VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE current_disease (id INT AUTO_INCREMENT NOT NULL, medical_files_id INT DEFAULT NULL, disease_name VARCHAR(255) DEFAULT NULL, disease_date DATE DEFAULT NULL, INDEX IDX_A536EF44DF7CB678 (medical_files_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE current_treatments (id INT AUTO_INCREMENT NOT NULL, medical_files_id INT DEFAULT NULL, treatment_name VARCHAR(255) DEFAULT NULL, INDEX IDX_95F3077FDF7CB678 (medical_files_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE housing (id INT AUTO_INCREMENT NOT NULL, place VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE medical_city (id INT AUTO_INCREMENT NOT NULL, city VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE previous_medical_operation (id INT AUTO_INCREMENT NOT NULL, medical_files_id INT DEFAULT NULL, medical_operation_type VARCHAR(255) DEFAULT NULL, operation_date DATE DEFAULT NULL, INDEX IDX_ED67C1E6DF7CB678 (medical_files_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE smoking_qte (id INT AUTO_INCREMENT NOT NULL, qte VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE specialisation (id INT AUTO_INCREMENT NOT NULL, spec VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tourisme_region (id INT AUTO_INCREMENT NOT NULL, medical_city_id INT DEFAULT NULL, arrival_date DATE NOT NULL, estimate_period VARCHAR(255) NOT NULL, guide TINYINT(1) NOT NULL, car TINYINT(1) NOT NULL, INDEX IDX_86EDC08ACDAE8261 (medical_city_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE patient_informations ADD CONSTRAINT FK_89C53BB75627D44C FOREIGN KEY (specialisation_id) REFERENCES specialisation (id)');
        $this->addSql('ALTER TABLE patient_informations ADD CONSTRAINT FK_89C53BB79FA2126B FOREIGN KEY (tourisme_region_id) REFERENCES tourisme_region (id)');
        $this->addSql('ALTER TABLE patient_informations ADD CONSTRAINT FK_89C53BB7AD5873E3 FOREIGN KEY (housing_id) REFERENCES housing (id)');
        $this->addSql('ALTER TABLE patient_informations ADD CONSTRAINT FK_89C53BB7B0A76B7D FOREIGN KEY (patient_folder_id) REFERENCES medical_files (id)');
        $this->addSql('ALTER TABLE patient_informations ADD CONSTRAINT FK_89C53BB7217F2928 FOREIGN KEY (patient_doctor_id) REFERENCES users (id)');
        $this->addSql('ALTER TABLE medical_files ADD CONSTRAINT FK_33D31B098101B95A FOREIGN KEY (qte_smoking_id) REFERENCES smoking_qte (id)');
        $this->addSql('ALTER TABLE medical_files ADD CONSTRAINT FK_33D31B09DE04DCEA FOREIGN KEY (qtealcohol_id) REFERENCES alcohol_qte (id)');
        $this->addSql('ALTER TABLE users ADD CONSTRAINT FK_1483A5E9AA8FA4FB FOREIGN KEY (spec_id) REFERENCES specialisation (id)');
        $this->addSql('ALTER TABLE current_disease ADD CONSTRAINT FK_A536EF44DF7CB678 FOREIGN KEY (medical_files_id) REFERENCES medical_files (id)');
        $this->addSql('ALTER TABLE current_treatments ADD CONSTRAINT FK_95F3077FDF7CB678 FOREIGN KEY (medical_files_id) REFERENCES medical_files (id)');
        $this->addSql('ALTER TABLE previous_medical_operation ADD CONSTRAINT FK_ED67C1E6DF7CB678 FOREIGN KEY (medical_files_id) REFERENCES medical_files (id)');
        $this->addSql('ALTER TABLE tourisme_region ADD CONSTRAINT FK_86EDC08ACDAE8261 FOREIGN KEY (medical_city_id) REFERENCES medical_city (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE patient_informations DROP FOREIGN KEY FK_89C53BB7B0A76B7D');
        $this->addSql('ALTER TABLE current_disease DROP FOREIGN KEY FK_A536EF44DF7CB678');
        $this->addSql('ALTER TABLE current_treatments DROP FOREIGN KEY FK_95F3077FDF7CB678');
        $this->addSql('ALTER TABLE previous_medical_operation DROP FOREIGN KEY FK_ED67C1E6DF7CB678');
        $this->addSql('ALTER TABLE patient_informations DROP FOREIGN KEY FK_89C53BB7217F2928');
        $this->addSql('ALTER TABLE medical_files DROP FOREIGN KEY FK_33D31B09DE04DCEA');
        $this->addSql('ALTER TABLE patient_informations DROP FOREIGN KEY FK_89C53BB7AD5873E3');
        $this->addSql('ALTER TABLE tourisme_region DROP FOREIGN KEY FK_86EDC08ACDAE8261');
        $this->addSql('ALTER TABLE medical_files DROP FOREIGN KEY FK_33D31B098101B95A');
        $this->addSql('ALTER TABLE patient_informations DROP FOREIGN KEY FK_89C53BB75627D44C');
        $this->addSql('ALTER TABLE users DROP FOREIGN KEY FK_1483A5E9AA8FA4FB');
        $this->addSql('ALTER TABLE patient_informations DROP FOREIGN KEY FK_89C53BB79FA2126B');
        $this->addSql('DROP TABLE patient_informations');
        $this->addSql('DROP TABLE medical_files');
        $this->addSql('DROP TABLE users');
        $this->addSql('DROP TABLE alcohol_qte');
        $this->addSql('DROP TABLE current_disease');
        $this->addSql('DROP TABLE current_treatments');
        $this->addSql('DROP TABLE housing');
        $this->addSql('DROP TABLE medical_city');
        $this->addSql('DROP TABLE previous_medical_operation');
        $this->addSql('DROP TABLE smoking_qte');
        $this->addSql('DROP TABLE specialisation');
        $this->addSql('DROP TABLE tourisme_region');
    }
}
