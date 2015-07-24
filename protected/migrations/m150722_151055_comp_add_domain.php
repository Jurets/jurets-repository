<?php

class m150722_151055_comp_add_domain extends CDbMigration
{
	public function up()
	{
        $this->addColumn('competition', 'subdomain', 'VARCHAR(50) DEFAULT NULL COMMENT "имя поддомена (устаревшее)"');
	}

	public function down()
	{
		$this->dropColumn('competition', 'subdomain');
	}

}