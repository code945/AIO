<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\web\View;

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
$js=' 
function login()
{ 
    if($("#input_username").val()!="" || $("#input_password").val()!="" )
    {
         $.post("/user/ajax/login",{"username":$("#input_username").val(),"password": $("#input_password").val()},function(result){
            if(result.error_code==1)
            {
                 
            }
            $("#msg").html(result.msg);
            $("#tips").show(); 
            setTimeout(function(){$("#tips").hide(); },2000);
          });
    } 
} 
';
$this->registerJs($js, View::POS_END);

?>
<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please fill out the following fields to login:</p>

    <div class="row">
        <div class="col-md-4">
           <div class="form-group">
               <label class="form-lable">用户名</label>
               <input id="input_username" class="form-control">
           </div>
            <div class="form-group">
                <label class="form-lable">密码</label>
                <input id="input_password" class="form-control" type="password">
            </div>
            <div id="tips" class="alert alert-warning alert-dismissible" style="display: none">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <p id="msg">Warning alert preview. This alert is dismissable.</p>
            </div>
            <button class="btn btn-default" onclick="login()">Login</button>

        </div>
    </div>
</div>
