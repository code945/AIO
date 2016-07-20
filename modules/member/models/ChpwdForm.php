<?php
namespace modules\member\models;

use Yii;
use yii\base\Model;

/**
 * Chpwd  form
 */
class ChpwdForm extends Model
{

    public $password;
    public $newpassword;
    public $repassword;
    private $_user;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['newpassword', 'password','repassword'], 'required','message' => '请输入密码信息'],
            ['password', 'validatePassword'],
            ['newpassword', 'string', 'min' => 6,'message' => '新密码长度应大于6位'],
            ['repassword', 'compare', 'compareAttribute' => 'newpassword','message'=>'两次输入的密码不一致！'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'password' => '原始密码',
            'newpassword' => '新密码',
            'repassword' => '重新输入新密码',
        ];
    }



    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, '用户名或密码错误.');
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     *
     * @return boolean whether the user is logged in successfully
     */
    public function ChangePassword()
    {
        if ($this->validate()) {
            $user = $this->getUser();
            $user->password = $this->newpassword;
            $user->save();
            return true;
        } else {
            return false;
        }
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    protected function getUser()
    {
        if ($this->_user === null) {
            $this->_user = Yii::$app->user->identity ;
        }

        return $this->_user;
    }
}
