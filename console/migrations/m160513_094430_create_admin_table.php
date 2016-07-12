<?php

use yii\db\Migration;

/**
 * Handles the creation for table `admin_table`.
 */
class m160513_094430_create_admin_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('admin', [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull()->unique(),
            'auth_key' => $this->string(32)->notNull(),
            'password_hash' => $this->string()->notNull(),
            'password_reset_token' => $this->string()->unique(),
            'email' => $this->string()->unique(),
            'wechat_id' => $this->string(100),
            'status' => $this->smallInteger()->defaultValue(10),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ]);

        $this->insert('admin',
            [
                'username'=>'admin',
                'password_hash'=>'$2y$13$yeCwq5lfMzse3rYGrX2cZOKXTmJ8.945Npt9TO2.nQ8h8xKUUkVua',
                'email'=>'lhx880619@163.com',
                'wechat_id'=>'8888',
                'status'=>10
            ]);


    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropTable('admin');
    }
}
