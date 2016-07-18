<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property string $id
 * @property string $username
 * @property string $auth_key
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $email
 * @property integer $status
 * @property string $nick_name
 * @property string $real_name
 * @property string $phone
 * @property string $wechat_id
 * @property string $wechat_name
 * @property string $qq
 * @property string $qq_name
 * @property string $header_img
 * @property string $gender
 * @property string $birthday
 * @property string $option
 * @property string $last_login
 * @property string $join_at
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username'], 'required'],
            [['status', 'last_login', 'join_at'], 'integer'],
            [['option'], 'string'],
            [['username', 'password_hash', 'password_reset_token', 'email', 'nick_name', 'real_name', 'phone', 'wechat_id', 'wechat_name', 'qq', 'qq_name', 'birthday'], 'string', 'max' => 200],
            [['auth_key'], 'string', 'max' => 32],
            [['header_img', 'gender'], 'string', 'max' => 500],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => '用户ID',
            'username' => '用户名',
            'auth_key' => 'Auth Key',
            'password_hash' => '密码',
            'password_reset_token' => '重置密码Token',
            'email' => '邮箱',
            'status' => '状态',
            'nick_name' => '昵称',
            'real_name' => '真实姓名',
            'phone' => '电话',
            'wechat_id' => '微信id',
            'wechat_name' => '微信昵称',
            'qq' => 'qq号',
            'qq_name' => 'qq昵称',
            'header_img' => '头像',
            'gender' => '性别',
            'birthday' => '生日',
            'option' => '其他扩展',
            'last_login' => '上次登录时间',
            'join_at' => '注册时间',
        ];
    }
 
}
