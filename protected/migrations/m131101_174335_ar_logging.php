<?php

class m131101_174335_ar_logging extends CDbMigration
{
	/*public function up()
	{
	}

	public function down()
	{
		echo "m131101_174335_ar_logging does not support migration down.\n";
		return false;
	}*/

	
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
        $this->createTable('activerecordlog',
            array(
                'id' => 'INT(10) UNSIGNED NOT NULL AUTO_INCREMENT',
                'description' => 'VARCHAR(255) DEFAULT NULL',
                'action' => 'VARCHAR(20) DEFAULT NULL',
                'model' => 'VARCHAR(45) DEFAULT NULL',
                'idModel' => 'INT(10) UNSIGNED DEFAULT NULL',
                'field' => 'VARCHAR(45) DEFAULT NULL',
                'creationdate' => 'TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP',
                'userid' => 'VARCHAR(45) DEFAULT NULL',
                'PRIMARY KEY (id)',
            )
        );
 
        //Index these bad boys for speedy lookups
    }

	public function safeDown()
	{
	}
	
}