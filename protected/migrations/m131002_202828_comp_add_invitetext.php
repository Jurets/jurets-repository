<?php
//добавить данные для главной страницы сроревнования - плакат-приглашение
class m131002_202828_comp_add_invitetext extends CDbMigration
{
	public function up()
	{
	    $this->addColumn('competition', 'invitation', 'TEXT');
    }

	public function down()
	{
		$this->dropColumn('competition', 'invitation');
	}

}