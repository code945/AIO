<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user common\models\User */
// /user/auth/active-email?userid='.$user->id.'&token='.$token;
$link = Yii::$app->urlManager->createAbsoluteUrl(
    [
        '/user/auth/active-email',
        'userid'=>$user->id,
        'token' => $token
    ]
);
?>
<div>
    <p>欢迎您！ <?= Html::encode($user->username) ?>,</p>
    <p>恭喜您已经完成注册，<a href="<?=$link ?>" target="_blank">请点击此处</a>激活您的邮箱。如果没有成功，您可以手动复制下面的链接到浏览器，手动激活。</p>
    <p style="background-color:#fffcc2"><?=$link ?></p> <br>
    <p>如果您在激活过程中有任何问题，请与我们客服联系，谢谢！</p>
</div>
