<?php

namespace modules\user\controllers;

use common\actions\DeleteAction;
use common\controllers\AjaxBaseController;
use common\helper\HttpHelper;
use common\models\User;
use common\models\UserSearchModel;
use kartik\grid\EditableColumnAction;
use Monolog\Handler\ElasticSearchHandler;
use Yii;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\Response;

/**
 * Default controller for the `user` module
 */
class AjaxController extends AjaxBaseController
{
  
    public function actionResetPwd()
    {
        $request = Yii::$app->request;
        $post = $request->post();
        $id = HttpHelper::getParams('id');
        Yii::$app->response->format = Response::FORMAT_JSON;
        return ['error_code'=>1,'msg'=>'success']; 
    }


    public function actionLogin()
    {
        $error_code = 0;
        $msg = '';
        $request = Yii::$app->request;
        $post = $request->post();
        $username = HttpHelper::getParams('username');
        $pwd = HttpHelper::getParams('password');
        $remember = HttpHelper::getParams('remember');
        if($username == null || $pwd == null)
        {
            $msg = '请正确输入用户名和密码';
        }
        else
        {
            $user = $this->getUser($username);
            if (!$user || !$user->validatePassword($pwd)) {
                $msg = '用户名密码不正确';
            }
            else if($user->status != User::STATUS_ACTIVE)
            {
                $msg = '用户未在激活状态';
            }
            else
            {
                $login = Yii::$app->user->login($user, $remember ? 3600 * 24 * 30 : 0);
                if($login)
                {
                    $error_code = 1;
                    $msg = '登陆成功';
                }
            }
        }
        return $this->json(['error_code'=>$error_code,'msg'=>$msg]);
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    function getUser($username)
    {
        return User::findByUsername($username,true);
    }

}
