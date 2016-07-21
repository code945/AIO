<?php

namespace modules\wechat\models;

use Yii;

/**
 * This is the model class for table "wechat_msg".
 *
 * @property string $id
 * @property integer $type
 * @property string $key_words
 * @property string $content
 * @property integer $status
 */
class WechatMsg extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'wechat_msg';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type', 'status'], 'integer'],
            [['key_words'], 'required'],
            [['content'], 'string'],
            [['key_words'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type' => '类型',
            'key_words' => '关键字',
            'content' => '内容',
            'status' => '状态',
        ];
    }
}
