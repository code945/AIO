<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use common\widgets\Popup;

/* @var $this yii\web\View */
/* @var $model backend\models\Admin */

$this->title = '修改密码';
$this->params['breadcrumbs'][] = $this->title;
//这是一段,在显示后定里消失的JQ代码
$this->registerJs("
        $('.alert-success').animate({opacity: 1.0}, 2000).fadeOut('slow');
    ");
 
?>
<div>
    <?php $form = ActiveForm::begin(); ?>

    <?= $form
        ->field($model, 'password')
        ->label('原始密码')
        ->passwordInput(['placeholder' => '原始密码' ])?>

    <?= $form
        ->field($model, 'newpassword')
        ->label('新密码')
        ->passwordInput(['placeholder' => '新密码' ])?>

    <?= $form
        ->field($model, 'repassword')
        ->label('确认新密码')
        ->passwordInput(['placeholder' => '确认新密码' ])?>

    <div class="form-group">
        <?= Html::submitButton('确认', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
