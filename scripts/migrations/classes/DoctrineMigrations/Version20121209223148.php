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
        $this->addSql("INSERT INTO `users` (`id`, `username`, `password`, `fname`, `lname`, `email`, `mobile`, `isactive`, `isadmin`) VALUES (NULL, 'admin123', 'pass123', 'john', 'smith', 'john@smith.com', '0777123456', '1', '1')");
        $this->addSql("INSERT INTO `users` (`id`, `username`, `password`, `fname`, `lname`, `email`, `mobile`, `isactive`, `isadmin`) VALUES (NULL, 'user21', 'pass123', 'bob', 'smith', 'bob@smith.com', '0777123456', '1', '0')");
        $this->addSql("INSERT INTO `users` (`id`, `username`, `password`, `fname`, `lname`, `email`, `mobile`, `isactive`, `isadmin`) VALUES (NULL, 'user22', 'pass123', 'bob', 'smith', 'bob@smith.com', '0777123456', '1', '0')");
        $this->addSql("INSERT INTO `users` (`id`, `username`, `password`, `fname`, `lname`, `email`, `mobile`, `isactive`, `isadmin`) VALUES (NULL, 'user23', 'pass123', 'bob', 'smith', 'bob@smith.com', '0777123456', '1', '0')");

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
        $this->addSql("INSERT INTO `tbl_doctors` (`id`, `city_id`, `name`, `address`, `phones`, `details`, `isactive`) VALUES (NULL, '1', 'Dr. Fernando 1', '42, Temple Rd, New Town.', '0776123456, 0112456789', '---', '1')");
        $this->addSql("INSERT INTO `tbl_doctors` (`id`, `city_id`, `name`, `address`, `phones`, `details`, `isactive`) VALUES (NULL, '2', 'Dr. Fernando 2', '42, Temple Rd, New Town.', '0776123456, 0112456789', '---', '1')");
        $this->addSql("INSERT INTO `tbl_doctors` (`id`, `city_id`, `name`, `address`, `phones`, `details`, `isactive`) VALUES (NULL, '3', 'Dr. Fernando 3', '42, Temple Rd, New Town.', '0776123456, 0112456789', '---', '1')");
        $this->addSql("INSERT INTO `tbl_doctors` (`id`, `city_id`, `name`, `address`, `phones`, `details`, `isactive`) VALUES (NULL, '4', 'Dr. Fernando 4', '42, Temple Rd, New Town.', '0776123456, 0112456789', '---', '1')");
        $this->addSql("INSERT INTO `tbl_doctors` (`id`, `city_id`, `name`, `address`, `phones`, `details`, `isactive`) VALUES (NULL, '5', 'Dr. Fernando 5', '42, Temple Rd, New Town.', '0776123456, 0112456789', '---', '1')");

        // load sample entries
        $this->addSql("LOAD DATA INFILE '$realpath/../../../data/entries.csv'
                        INTO TABLE entries
                            FIELDS TERMINATED BY ','
                                OPTIONALLY ENCLOSED BY '\"'");

        /* Add INDEXes */
        $this->addSql("ALTER TABLE `cities` ADD INDEX ( `name` )");        
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
        
        // truncate doctors table
        $this->addSql("TRUNCATE TABLE `tbl_doctors`");

        // truncate cities table
        $this->addSql("TRUNCATE TABLE `cities`");

        // truncate areas table
        $this->addSql("TRUNCATE TABLE `areas`");
        
        // truncate entries table
        $this->addSql("TRUNCATE TABLE `entries`");

    }
    
}
