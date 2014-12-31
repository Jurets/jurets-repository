<?php

class m141230_062949_add_comp_type extends CDbMigration
{
	public function up()
	{
        $this->addColumn('competition', 'type', 'VARCHAR(30) NOT NULL DEFAULT "competition" COMMENT "тип (соревнование, сборы)"');
	}

	public function down()
	{
		$this->dropColumn('competition', 'type');
	}

}