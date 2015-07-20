
<?php

class m150720_074028_add_secondname extends CDbMigration
{
	public function up()
	{
        $this->addColumn('command', 'secondname', "varchar(255) DEFAULT NULL COMMENT 'имя для отображения в протоколах EXCEL'");
	}

	public function down()
	{
		$this->dropColumn('command', 'secondname');
	}

}
