<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210608235918 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE medical_files DROP FOREIGN KEY FK_33D31B096ED78C3');
        $this->addSql('ALTER TABLE medical_files DROP FOREIGN KEY FK_33D31B091E058452');
        $this->addSql('CREATE TABLE alcohol_qte (id INT AUTO_INCREMENT NOT NULL, qte VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE current_disease (id INT AUTO_INCREMENT NOT NULL, medical_files_id INT DEFAULT NULL, disease_name VARCHAR(255) DEFAULT NULL, disease_date DATE DEFAULT NULL, INDEX IDX_A536EF44DF7CB678 (medical_files_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE current_treatments (id INT AUTO_INCREMENT NOT NULL, medical_files_id INT DEFAULT NULL, treatment_name VARCHAR(255) DEFAULT NULL, INDEX IDX_95F3077FDF7CB678 (medical_files_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE previous_medical_operation (id INT AUTO_INCREMENT NOT NULL, medical_files_id INT DEFAULT NULL, medical_operation_type VARCHAR(255) DEFAULT NULL, operation_date DATE DEFAULT NULL, INDEX IDX_ED67C1E6DF7CB678 (medical_files_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE smoking_qte (id INT AUTO_INCREMENT NOT NULL, qte VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE current_disease ADD CONSTRAINT FK_A536EF44DF7CB678 FOREIGN KEY (medical_files_id) REFERENCES medical_files (id)');
        $this->addSql('ALTER TABLE current_treatments ADD CONSTRAINT FK_95F3077FDF7CB678 FOREIGN KEY (medical_files_id) REFERENCES medical_files (id)');
        $this->addSql('ALTER TABLE previous_medical_operation ADD CONSTRAINT FK_ED67C1E6DF7CB678 FOREIGN KEY (medical_files_id) REFERENCES medical_files (id)');
        $this->addSql('DROP TABLE file_informations');
        $this->addSql('DROP TABLE historical');
        $this->addSql('DROP INDEX UNIQ_33D31B096ED78C3 ON medical_files');
        $this->addSql('DROP INDEX UNIQ_33D31B091E058452 ON medical_files');
        $this->addSql('ALTER TABLE medical_files ADD qte_smoking_id INT DEFAULT NULL, ADD qtealcohol_id INT DEFAULT NULL, ADD weight INT NOT NULL, ADD size INT NOT NULL, ADD is_smoking TINYINT(1) NOT NULL, ADD is_alcohloic TINYINT(1) NOT NULL, ADD health_info LONGTEXT NOT NULL, ADD is_approved TINYINT(1) NOT NULL, ADD is_rejected TINYINT(1) NOT NULL, ADD email_confirmed TINYINT(1) NOT NULL, DROP file_info_id, DROP history_id');
        $this->addSql('ALTER TABLE medical_files ADD CONSTRAINT FK_33D31B098101B95A FOREIGN KEY (qte_smoking_id) REFERENCES smoking_qte (id)');
        $this->addSql('ALTER TABLE medical_files ADD CONSTRAINT FK_33D31B09DE04DCEA FOREIGN KEY (qtealcohol_id) REFERENCES alcohol_qte (id)');
        $this->addSql('CREATE INDEX IDX_33D31B098101B95A ON medical_files (qte_smoking_id)');
        $this->addSql('CREATE INDEX IDX_33D31B09DE04DCEA ON medical_files (qtealcohol_id)');
        $this->addSql('ALTER TABLE patient_informations ADD patient_folder_id INT DEFAULT NULL, ADD patient_doctor_id INT DEFAULT NULL, ADD is_approved TINYINT(1) NOT NULL, ADD is_rejected TINYINT(1) NOT NULL, ADD email_comfired TINYINT(1) NOT NULL, ADD report LONGTEXT DEFAULT NULL, ADD informations_confirmed TINYINT(1) NOT NULL, ADD report_done TINYINT(1) NOT NULL, ADD patient_confirmed TINYINT(1) NOT NULL, ADD patient_not_confirmed TINYINT(1) NOT NULL, ADD invoice_sent TINYINT(1) NOT NULL, CHANGE housing_id housing_id INT DEFAULT NULL, CHANGE specialisation_id specialisation_id INT DEFAULT NULL, CHANGE tourisme_region_id tourisme_region_id INT DEFAULT NULL, CHANGE age age INT DEFAULT NULL, CHANGE sexe sexe VARCHAR(50) DEFAULT NULL');
        $this->addSql('ALTER TABLE patient_informations ADD CONSTRAINT FK_89C53BB7B0A76B7D FOREIGN KEY (patient_folder_id) REFERENCES medical_files (id)');
        $this->addSql('ALTER TABLE patient_informations ADD CONSTRAINT FK_89C53BB7217F2928 FOREIGN KEY (patient_doctor_id) REFERENCES users (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_89C53BB7B0A76B7D ON patient_informations (patient_folder_id)');
        $this->addSql('CREATE INDEX IDX_89C53BB7217F2928 ON patient_informations (patient_doctor_id)');
        $this->addSql('ALTER TABLE tourisme_region CHANGE medical_city_id medical_city_id INT DEFAULT NULL, CHANGE guide guide TINYINT(1) NOT NULL, CHANGE car car TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE users CHANGE spec_id spec_id INT DEFAULT NULL, CHANGE roles roles JSON NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE medical_files DROP FOREIGN KEY FK_33D31B09DE04DCEA');
        $this->addSql('ALTER TABLE medical_files DROP FOREIGN KEY FK_33D31B098101B95A');
        $this->addSql('CREATE TABLE file_informations (id INT AUTO_INCREMENT NOT NULL, weight INT NOT NULL, size INT NOT NULL, smoking TINYINT(1) NOT NULL, alcoholic TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE historical (id INT AUTO_INCREMENT NOT NULL, current_disease VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, current_medications VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, previous_operations VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, health LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('DROP TABLE alcohol_qte');
        $this->addSql('DROP TABLE current_disease');
        $this->addSql('DROP TABLE current_treatments');
        $this->addSql('DROP TABLE previous_medical_operation');
        $this->addSql('DROP TABLE smoking_qte');
        $this->addSql('DROP INDEX IDX_33D31B098101B95A ON medical_files');
        $this->addSql('DROP INDEX IDX_33D31B09DE04DCEA ON medical_files');
        $this->addSql('ALTER TABLE medical_files ADD file_info_id INT NOT NULL, ADD history_id INT NOT NULL, DROP qte_smoking_id, DROP qtealcohol_id, DROP weight, DROP size, DROP is_smoking, DROP is_alcohloic, DROP health_info, DROP is_approved, DROP is_rejected, DROP email_confirmed');
        $this->addSql('ALTER TABLE medical_files ADD CONSTRAINT FK_33D31B091E058452 FOREIGN KEY (history_id) REFERENCES historical (id)');
        $this->addSql('ALTER TABLE medical_files ADD CONSTRAINT FK_33D31B096ED78C3 FOREIGN KEY (file_info_id) REFERENCES file_informations (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_33D31B096ED78C3 ON medical_files (file_info_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_33D31B091E058452 ON medical_files (history_id)');
        $this->addSql('ALTER TABLE patient_informations DROP FOREIGN KEY FK_89C53BB7B0A76B7D');
        $this->addSql('ALTER TABLE patient_informations DROP FOREIGN KEY FK_89C53BB7217F2928');
        $this->addSql('DROP INDEX UNIQ_89C53BB7B0A76B7D ON patient_informations');
        $this->addSql('DROP INDEX IDX_89C53BB7217F2928 ON patient_informations');
        $this->addSql('ALTER TABLE patient_informations DROP patient_folder_id, DROP patient_doctor_id, DROP is_approved, DROP is_rejected, DROP email_comfired, DROP report, DROP informations_confirmed, DROP report_done, DROP patient_confirmed, DROP patient_not_confirmed, DROP invoice_sent, CHANGE specialisation_id specialisation_id INT DEFAULT NULL, CHANGE tourisme_region_id tourisme_region_id INT DEFAULT NULL, CHANGE housing_id housing_id INT DEFAULT NULL, CHANGE age age INT DEFAULT NULL, CHANGE sexe sexe VARCHAR(50) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE tourisme_region CHANGE medical_city_id medical_city_id INT DEFAULT NULL, CHANGE guide guide VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE car car VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE users CHANGE spec_id spec_id INT DEFAULT NULL, CHANGE roles roles LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_bin`');
    }
}
