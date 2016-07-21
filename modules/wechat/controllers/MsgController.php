<?php

namespace modules\wechat\controllers;

use EasyWeChat\Foundation\Application;
use modules\wechat\models\WechatMsg;
use Overtrue\Socialite\User;
use Yii;
use yii\base\Object;
use yii\web\Controller;
use yii\web\Response;

/**
 * Default controller for the `wechat` module
 */
class MsgController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionSubscribe()
    {
        $model = WechatMsg::findOne(['type'=>1]);
        if ($model->load(Yii::$app->request->post())) {
            $model->save();
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ['error_code'=>1,'msg'=>'success'];
        }
        return $this->render('subscribe',['model'=>$model]);
    }
 

}
