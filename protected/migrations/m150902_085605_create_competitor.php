<?php

class m150902_085605_create_competitor extends CDbMigration
{
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
        $this->createTable('competitor', array(
            'id' => 'int(11) unsigned NOT NULL AUTO_INCREMENT',
            'lastname' => 'varchar(40) NOT NULL COMMENT "фамилия"',
            'firstname' => 'varchar(30) NOT NULL COMMENT "имя"',
            'middlename' => 'varchar(30) NOT NULL COMMENT "отчество"',
            'birthdate' => 'date DEFAULT NULL COMMENT "дата (год) рождения"',
            'gender' => 'CHAR(1) NOT NULL COMMENT "пол: M - муж., F - жен."',
            'identcode' => 'VARCHAR(20) DEFAULT NULL',
            'fstid' => 'INT(11) DEFAULT NULL COMMENT "ссылка ФСТ"',
            'rankid' => 'INT(11) DEFAULT NULL COMMENT "ссылка спортивный разряд"', // Category
            'gradeid' => 'INT(11) DEFAULT NULL COMMENT "аттестационный уровень"', // AttestLevel
            //'ageid' => 'INT(11) DEFAULT NULL',
            //'weigthid' => 'INT(11) DEFAULT NULL',
            'coachid' => 'INT(11) DEFAULT NULL COMMENT "тренер"',
            'coach1id' => 'INT(11) DEFAULT NULL COMMENT "первый тренер"',
            'photoid' => 'INT(11) UNSIGNED DEFAULT NULL COMMENT "ссылка на фото"',
            'userid' => 'INT(11) DEFAULT NULL COMMENT "кто создал"',
            'created' => 'TIMESTAMP DEFAULT CURRENT_TIMESTAMP COMMENT "время создания"',
            'editdate' => 'DATETIME DEFAULT NULL COMMENT "последнее изменение"',
            'edituserid' => 'INT(11) DEFAULT NULL COMMENT "автор изменения"',
            'status' => 'TINYINT(4) UNSIGNED NOT NULL DEFAULT 1 COMMENT "Статус (1 - активен, 0 - нет)"',
            'sportsmenid' => 'INT(11) DEFAULT NULL COMMENT "ссылка на единую базу спортсменов"',
            'PRIMARY KEY (id)'
            ), 
        'ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci');
        
        $this->addForeignKey('FK_competitor_fst', 'competitor', 'fstid', 'fst', 'FstID');
        $this->addForeignKey('FK_competitor_rank', 'competitor', 'rankid', 'sportcategory', 'CategoryID');
        $this->addForeignKey('FK_competitor_grade', 'competitor', 'gradeid', 'attestlevel', 'AttestLevelID');
        $this->addForeignKey('FK_competitor_coach', 'competitor', 'coachid', 'coach', 'CoachID');
        $this->addForeignKey('FK_competitor_coach1', 'competitor', 'coach1id', 'coach', 'CoachID');
        $this->addForeignKey('FK_competitor_photo', 'competitor', 'photoid', 'photo', 'photo_id');
        $this->addForeignKey('FK_competitor_user', 'competitor', 'userid', 'user', 'UserID');
	}

	public function safeDown()
	{
        $this->dropForeignKey('FK_competitor_fst', 'competitor');
        $this->dropForeignKey('FK_competitor_rank', 'competitor');
        $this->dropForeignKey('FK_competitor_grade', 'competitor');
        $this->dropForeignKey('FK_competitor_coach', 'competitor');
        $this->dropForeignKey('FK_competitor_coach1', 'competitor');
        $this->dropForeignKey('FK_competitor_photo', 'competitor');
        $this->dropForeignKey('FK_competitor_user', 'competitor');

        $this->dropTable('competitor');
    }

}
