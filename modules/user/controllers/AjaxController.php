<?php

namespace modules\user\controllers;

use common\actions\DeleteAction;
use common\helper\HttpHelper;
use common\models\User;
use common\models\UserSearchModel;
use kartik\grid\EditableColumnAction;
use Yii;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\Response;

/**
 * Default controller for the `user` module
 */
class AjaxController extends Controller
{
 



    public function beforeAction($action)
    {
        if($action->id == 'reset-pwd')
            $this->enableCsrfValidation = false;
        return parent::beforeAction($action); // TODO: Change the autogenerated stub
    }


    public function actionResetPwd()
    {
        $request = Yii::$app->request;
        $post = $request->post();
        $id = HttpHelper::getParams('id');
        Yii::$app->response->format = Response::FORMAT_JSON;
        return ['error_code'=>1,'msg'=>'success'];
    }
 

}