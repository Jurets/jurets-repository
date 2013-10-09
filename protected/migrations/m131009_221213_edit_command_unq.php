<?php

class m131009_221213_edit_command_unq extends CDbMigration
{
	public function safeUp()
	{
        $this->dropIndex('CommandName', 'command');
        $this->createIndex('CommandName', 'command', 'competitionid, CommandName', true);
	}

	public function down()
	{
		echo "m131009_221213_edit_command_unq does not support migration down.\n";
		return false;
	}
}
?>