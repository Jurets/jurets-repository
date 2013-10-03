<?php

class m131003_212802_comp_add_path extends CDbMigration
{
    public function up()
    {
        $this->addColumn('competition', 'path', 'VARCHAR(50)');
    }

    public function down()
    {
        $this->dropColumn('competition', 'path');
    }
}