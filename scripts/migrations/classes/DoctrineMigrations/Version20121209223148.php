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
        $this->addSql("INSERT INTO `Categories` (`id`, `name`, `descrip`, `isactive`) VALUES (NULL, 'Doctor', '---', '1')");
        $this->addSql("INSERT INTO `Categories` (`id`, `name`, `descrip`, `isactive`) VALUES (NULL, 'Super Market', '---', '1')");
        $this->addSql("INSERT INTO `Categories` (`id`, `name`, `descrip`, `isactive`) VALUES (NULL, 'Pharmacy', '---', '1')");

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
        // add INDEX to city names
        $this->addSql("ALTER TABLE `cities` ADD INDEX ( `name` )");
    }

    public function down(Schema $schema)
    {
        //drop test table
	$schema->dropTable('test');
        // truncate users table
        $this->addSql("TRUNCATE TABLE `users`");
        // truncate category table
        $this->addSql("TRUNCATE TABLE `categories`");
        // truncate cities table
        $this->addSql("TRUNCATE TABLE `cities`");
        // truncate areas table
        $this->addSql("TRUNCATE TABLE `areas`");

    }
    
}
