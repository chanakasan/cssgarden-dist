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
    }

    public function down(Schema $schema)
    {
	$schema->dropTable('test');
    }
}
