<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230818072754 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'create table country_tax coupon product';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE SEQUENCE country_tax_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE coupon_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE product_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE country_tax (id INT NOT NULL, percent INT NOT NULL, format VARCHAR(255) NOT NULL, code VARCHAR(255) NOT NULL, symbol VARCHAR(255) DEFAULT NULL, full_tax_number VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE coupon (id INT NOT NULL, type VARCHAR(255) NOT NULL, code VARCHAR(255) NOT NULL, amount NUMERIC(9, 2) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE product (id INT NOT NULL, name VARCHAR(255) NOT NULL, price_rub_amount NUMERIC(9, 2) DEFAULT NULL, price_usd_amount NUMERIC(9, 2) DEFAULT NULL, price_eur_amount NUMERIC(9, 2) DEFAULT NULL, PRIMARY KEY(id))');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP SEQUENCE country_tax_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE coupon_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE product_id_seq CASCADE');
        $this->addSql('DROP TABLE country_tax');
        $this->addSql('DROP TABLE coupon');
        $this->addSql('DROP TABLE product');
    }
}
