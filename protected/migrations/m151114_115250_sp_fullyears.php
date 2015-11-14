
<?php

class m151114_115250_sp_fullyears extends CDbMigration
{
	public function up()
	{
        $this->addColumn('sportsmen', 'fullyears', 'TINYINT(2)');
	}

	public function down()
	{
		$this->dropColumn('sportsmen', 'fullyears');
	}
}
