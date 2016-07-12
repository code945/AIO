<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
use yii\web\View;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

$this->title = 'Sign In';

$fieldOptions1 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-envelope form-control-feedback'></span>"
];

$fieldOptions2 = [
    'options' => ['class' => 'form-group has-feedback'],
    'inputTemplate' => "{input}<span class='glyphicon glyphicon-lock form-control-feedback'></span>"
];
$code = \common\helper\CommonHelper::guid();
$js='
 
var ws = new WebSocket("ws://www.linhongxu.com:7272");
ws.onopen = function(){
	var init_data = \'{"type":"init","task_id":"'.$code.'"}\'; 
    ws.send(init_data);
};
ws.onmessage = function(e){
    console.log(e.data);
    var data = eval("("+e.data+")");
    switch(data[\'type\']) {
            // 服务端ping客户端
        case \'ping\':
            ws.send(\'{"type":"pong"}\');
            break;
        case \'login_status\':
            if(data["openid"] != "") 
            location.href="/site/wechat-auth-handler?openid=" + data["openid"] ;
            break;
    }
};


$(document).ready(function () {
    $("#qrimg").attr("src","'.Yii::getAlias('@authQRCodeUrl').'?auth_type=admin&task_id='.$code.'&target_back=http://admin.linhongxu.com/site/wechat-auth-handler"); 
    });
        ';
$this->registerJs($js, View::POS_END);

?>

<div class="login-box" style="width: 600px;">
    <div class="login-logo">
        <a href="#">系统后台</a>
    </div>
    <!-- /.login-logo -->
    <div class="login-box-body">
        <p class="login-box-msg">登陆后开始管理</p>
        <div class="col-lg-6">
            <?php $form = ActiveForm::begin(['id' => 'login-form', 'enableClientValidation' => false]); ?>

            <?= $form
                ->field($model, 'username', $fieldOptions1)
                ->label(false)
                ->textInput(['placeholder' => $model->getAttributeLabel('username')]) ?>

            <?= $form
                ->field($model, 'password', $fieldOptions2)
                ->label(false)
                ->passwordInput(['placeholder' => $model->getAttributeLabel('password')]) ?>

            <?= $form
                ->field($model, 'verifyCode')
                ->label(false)
                ->widget(Captcha::className(), [
                    'template' => '<div class="input-group"> 
                                {input}
                                <span class="input-group-addon" style="padding-left:10px; padding-right:10px;">{image}</span>
                            </div>',
                    'options' => ['class' => 'form-control',  'maxlength'=>"4", 'placeholder'=>"验证码" ],
                    'imageOptions' =>['style'=>'height:20px', 'border'=>'0', 'alt'=>"点击更换验证码"  ]
                ]) ?>



            <div class="row">
                <div class="col-xs-8">
                    <?= $form->field($model, 'rememberMe')
                        ->checkbox()
                        ->label($model->getAttributeLabel('rememberMe')) ?>
                </div>
                <!-- /.col -->
                <div class="col-xs-4">
                    <?= Html::submitButton('登陆', ['class' => 'btn btn-primary btn-block btn-flat', 'name' => 'login-button']) ?>
                </div>
                <!-- /.col -->
            </div>

            <?php ActiveForm::end(); ?>
        </div>
        <div class="col-lg-6">
            <div class="text-center">
                <img id="qrimg">
                <p>- 微信扫码登陆-</p>
            </div>
            <!-- /.social-auth-links -->
        </div>
        <div style="clear: both"></div>
    </div>
    <!-- /.login-box-body -->
</div><!-- /.login-box -->
