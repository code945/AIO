<?php

use yii\db\Migration;

/**
 * Handles the creation for table `wechat_msg`.
 */
class m160721_070240_create_wechat_msg extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('wechat_msg', [
            'id' => "bigint(20) unsigned primary key NOT NULL AUTO_INCREMENT COMMENT 'ID'",
            'type' => "int  COMMENT '类型 1：欢迎词 2：文字 3：文章'",
            'key_words' =>  "varchar(200)  NOT NULL  COMMENT '关键字'",
            'content' =>"text  COMMENT '内容'",
            'status' => "int default 1  COMMENT '状态'",
        ]);

        $this->insert('wechat_msg',[
            'type' => 1,
            'key_words' =>  'subscribe',
            'content' =>"welcome"
        ]);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable('wechat_msg');
    }
}
