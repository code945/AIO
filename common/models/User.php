<?php

namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

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
class User extends ActiveRecord  implements IdentityInterface
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }
    const STATUS_ACTIVE = 1;

    const STATUS =  [
        '0'=>'待激活',
        '1'=>'已激活',
        '-1'=>'冻结',
    ] ;

    const STATUS_LABEL =  [
        '0'=> '<span class="label label-info">待激活</span>',
        '1'=>'<span class="label label-success">已激活</span>',
        '-1'=>'<span class="label label-danger">冻结</span>',
    ] ;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username'], 'required'],
            [['status'], 'integer'],
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

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username,$seacrhAll = false)
    {
        if($seacrhAll)
        {
            $query = static::find()
                ->orFilterWhere(['username' => $username])
                ->orFilterWhere(['phone' => $username])
                ->orFilterWhere(['email' => $username])
                ->one();
            return $query;
        }
        else
            return static::findOne(['username' => $username]);
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return boolean
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }
}
