<?php
namespace DoctrineMigrations;

use \Doctrine\DBAL\Migrations\AbstractMigration,
    \Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your need!
 */
class Version20121209223148 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // create test table
	$table = $schema->createTable('test');
        $table->addColumn('username', 'string');
        $table->addColumn('password', 'string');

        // insert admin user
        $this->addSql("INSERT INTO `users` (`id`, `username`, `password`, `fname`, `lname`, `email`, `mobile`, `isactive`, `isadmin`) VALUES (NULL, 'chan89', 'pass123', 'chanaka', 'sandaruwan', 'chan@my.com', '0777123456', '1', '1')");

        // insert customer category
        $this->addSql("INSERT INTO `Categories` (`id`, `name`, `descrip`, `isactive`, `entityName`) VALUES (NULL, 'Doctor', '---', '1', 'Doctor')");
//        $this->addSql("INSERT INTO `Categories` (`id`, `name`, `descrip`, `isactive`, 'entityName') VALUES (NULL, 'Super Market', '---', '1', 'SuperMarket')");
//        $this->addSql("INSERT INTO `Categories` (`id`, `name`, `descrip`, `isactive`, 'entityName') VALUES (NULL, 'Pharmacy', '---', '1', 'Pharmacy')");
//        $this->addSql("INSERT INTO `Categories` (`id`, `name`, `descrip`, `isactive`, 'entityName') VALUES (NULL, 'Salon', '---', '1', 'Salon')");
        

        /* Load Fixtures from file */
        $realpath = realpath(__FILE__);
        // load areas list        
        $this->addSql("LOAD DATA INFILE '$realpath/../../../data/area.csv'
                        INTO TABLE areas
                            FIELDS TERMINATED BY ','
                                OPTIONALLY ENCLOSED BY '\"'");
        // load cities list        
        $this->addSql("LOAD DATA INFILE '$realpath/../../../data/city.csv'
                        INTO TABLE cities
                            FIELDS TERMINATED BY ','
                                OPTIONALLY ENCLOSED BY '\"'");

        // insert data to table doctors
        $this->addSql("INSERT INTO `doctors` (`id`, `city_id`, `name`, `address`, `phones`, `details`, `isactive`) VALUES (NULL, '1', 'Dr. Nimal Fernando', '42, Temple Rd, New Town.', '0776123456, 0112456789', '---', '1')");

        
        /* Add indexes */

        // add INDEX to city names
        $this->addSql("ALTER TABLE `cities` ADD INDEX ( `name` )");
        // add INDEXes to entries table
        $this->addSql("ALTER TABLE `entries` ADD INDEX ( `cat` )");
        $this->addSql("ALTER TABLE `entries` ADD INDEX ( `area` )");
        $this->addSql("ALTER TABLE `entries` ADD INDEX ( `city` )");

    }

    public function down(Schema $schema)
    {
        //drop test table
	$schema->dropTable('test');
        // truncate users table
        $this->addSql("TRUNCATE TABLE `users`");
        // truncate category table
        $this->addSql("TRUNCATE TABLE `categories`");
        
        // truncate doctors table
        $this->addSql("TRUNCATE TABLE `doctors`");

        // truncate cities table
        $this->addSql("TRUNCATE TABLE `cities`");
        // truncate areas table
        $this->addSql("TRUNCATE TABLE `areas`");
        // truncate entries table
        $this->addSql("TRUNCATE TABLE `entries`");

    }
    
}
