<?php

use yii\db\Migration;

/**
 * Handles the creation for table `category_table`.
 */
class m160517_025408_create_category_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function safeUp()
    {
        $this->createTable('category', [
            'id' => $this->primaryKey(),
            'pid'=> $this->integer(),
            'name' => $this->string(200)->notNull(),
            'created_at' => $this->datetime(),
            'updated_at' => $this->datetime(),
            'sort'=> $this->integer()->defaultValue(0),
        ]);

        $this->addForeignKey('fk_category_pid', 'category', 'pid', 'category', 'id', 'CASCADE');

        $this->insert('category',['name'=>'PHP','sort'=>1]);
        $this->insert('category',['name'=>'.NET','sort'=>2]);
        $this->insert('category',['name'=>'DataBase','sort'=>3]);
        $this->insert('category',['name'=>'前端','sort'=>4]);
        $this->insert('category',['name'=>'生活随笔','sort'=>5]);
    }

    /**
     * @inheritdoc
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_category_pid','category');
        $this->dropTable('category');
    }
}
