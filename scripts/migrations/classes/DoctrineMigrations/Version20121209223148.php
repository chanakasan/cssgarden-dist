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
	$table = $schema->createTable('test');
        $table->addColumn('username', 'string');
        $table->addColumn('password', 'string');
        // insert admin user
        $this->addSql("INSERT INTO `dcr_dev`.`users` (`id`, `username`, `password`, `fname`, `lname`, `email`, `mobile`, `isactive`, `isadmin`) VALUES (NULL, 'chan89', 'pass123', 'chanaka', 'sandaruwan', 'chan@my.com', '0777123456', '1', '1')");       
        $this->addSql("INSERT INTO `dcr_dev`.`Categories` (`id`, `name`, `descrip`, `isactive`) VALUES (NULL, 'Doctor', '---', '1')");
//        $this->addSql("LOAD DATA INFILE '/Users/CS/Sites/dcr-proj/data/areas.yml'
//            INTO TABLE dcr-dev.areas CHARACTER SET utf8
//            FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '\"'
//            LINES TERMINATED BY '\r';");

    }

    public function down(Schema $schema)
    {
	$schema->dropTable('test');
    }
    
}
