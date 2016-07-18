<?php

use yii\db\Migration;

/**
 * Handles the creation for table `user_table`.
 */
class m160718_091255_create_user_table extends Migration
{
    public function safeUp()
    {
        $this->execute('DROP TABLE IF EXISTS {{%user}};');
        $this->createTable('{{%user}}', [
            'id' => "bigint(20) unsigned primary key NOT NULL AUTO_INCREMENT COMMENT '用户ID'",
            'username' =>  "varchar(200)  NOT NULL  COMMENT '用户名'",
            'auth_key' =>"varchar(32)  COMMENT 'Auth Key'",
            'password_hash' =>"varchar(200)  COMMENT '密码'",
            'password_reset_token' => "varchar(200)  COMMENT '重置密码Token'",
            'email' => "varchar(200)  COMMENT '邮箱'",
            'status' => "int  COMMENT '状态'",
            'nick_name'=>"varchar(200)  COMMENT '昵称'",
            'real_name'=>"varchar(200)  COMMENT '真实姓名'",
            'phone'=>"varchar(200)  COMMENT '电话'",
            'wechat_id'=>"varchar(200)  COMMENT '微信id'",
            'wechat_name'=>"varchar(200)  COMMENT '微信昵称'",
            'qq'=>"varchar(200)  COMMENT 'qq号'",
            'qq_name'=>"varchar(200)  COMMENT 'qq昵称'",
            'header_img'=>"varchar(500)  COMMENT '头像'",
            'gender'=>"varchar(500)  COMMENT '性别'",
            'birthday'=>"varchar(200)  COMMENT '生日'",
            'option'=>"text  COMMENT '其他扩展'",
            'last_login'=>"int(10) unsigned COMMENT '上次登录时间'",
            'join_at'=>"int(10) unsigned COMMENT '注册时间'"
        ] );
    }

    public function safeDown()
    {
        $this->dropTable('{{%user}}');
    }


}
