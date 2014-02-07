<?php

class m140207_222147_posts extends CDbMigration
{
	// Use safeUp/safeDown to do migration with transaction
	public function safeUp()
	{
        $this->execute('
            CREATE TABLE ftudb.post(
              id INT(11) NOT NULL AUTO_INCREMENT,
              position TINYINT(4) DEFAULT 1 COMMENT "позиция в списке",
              title VARCHAR(255) NOT NULL COMMENT "заголовок",
              `text` TEXT DEFAULT NULL COMMENT "текст",
              competitionid INT(11) NOT NULL COMMENT "ИД соревнования",
              controllerid VARCHAR(255) DEFAULT NULL COMMENT "имя контроллера",
              actionid VARCHAR(255) DEFAULT NULL COMMENT "имя действия",
              creationdate TIMESTAMP DEFAULT CURRENT_TIMESTAMP COMMENT "дата и время",
              userid INT(11) NOT NULL COMMENT "ИД юзера",
              PRIMARY KEY (id),
              CONSTRAINT FK_post_competition_id FOREIGN KEY (competitionid)
              REFERENCES ftudb.competition (id) ON DELETE RESTRICT ON UPDATE RESTRICT,
              CONSTRAINT FK_post_user_UserID FOREIGN KEY (userid)
              REFERENCES ftudb.user (UserID) ON DELETE RESTRICT ON UPDATE RESTRICT
            )
            ENGINE = INNODB
            AUTO_INCREMENT = 1
            CHARACTER SET utf8
            COLLATE utf8_general_ci
            COMMENT = "Пост (выкладывается на любую страницу)";'
        );
        
        $this->execute('
            CREATE TABLE ftudb.postfiles(
              id INT(11) NOT NULL AUTO_INCREMENT,
              postid INT(11) NOT NULL COMMENT "ИД поста",
              position TINYINT(4) NOT NULL DEFAULT 1 COMMENT "позиция в списке",
              filename VARCHAR(255) NOT NULL COMMENT "имя файла (сгенерированное)",
              origname VARCHAR(255) NOT NULL COMMENT "имя файла (оригинальное)",
              type VARCHAR(255) DEFAULT NULL COMMENT "тип файла",
              filesize INT(11) NOT NULL COMMENT "размер (в байтах)",
              PRIMARY KEY (id),
              CONSTRAINT FK_postfiles_post_id FOREIGN KEY (postid)
              REFERENCES ftudb.post (id) ON DELETE RESTRICT ON UPDATE RESTRICT
            )
            ENGINE = INNODB
            AUTO_INCREMENT = 1
            CHARACTER SET utf8
            COLLATE utf8_general_ci;');
    }

	public function safeDown()
	{
        $this->dropTable('posts');
        $this->dropTable('postfiles');
	}
	
}