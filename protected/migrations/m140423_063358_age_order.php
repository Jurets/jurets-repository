<?php

class m140423_063358_age_order extends CDbMigration
{
	public function up()
	{
        $this->addColumn('agecategory', 'ordernum', 'TINYINT(2) DEFAULT NULL');
	}

	public function down()
	{
		$this->dropColumn('agecategory', 'ordernum');
	}

}