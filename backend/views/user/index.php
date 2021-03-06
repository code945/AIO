<?php

use yii\helpers\Html;
use kartik\grid\GridView;
/* @var $this yii\web\View */
/* @var $searchModel common\models\UserSearchModel */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">
 
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
    'panel' => [
        'heading'=>false,//不要了
        'before'=>'<div style="margin-top:8px">{summary}</div>',//放在before中，前面的div主要是想让它好看
        'after'=>false,
        'footer'=>'<div class="pull-right"><a class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i> 批量删除</a></div>',
        ],
     'panelFooterTemplate'=>'<div class="kv-panel-pager pull-left"> {pager} </div>
            {footer}
            <div class="clearfix"></div>
            ',
    'toolbar'=> [
        ['content'=>
            Html::a('<i class="glyphicon glyphicon-plus"></i>',['create'], ['type'=>'button', 'title'=>'Add', 'class'=>'btn btn-success']).' '.
            Html::a('<i class="glyphicon glyphicon-repeat"></i>', [''], ['data-pjax'=>0, 'class'=>'btn btn-default', 'title'=>'Reset Grid'])
        ],
    ],
    'export'=>false,
    'resizableColumns'=>true,
    'pjax'=>true, // pjax is set to always true for this demo
    'hover'=>true,//鼠标移动上去时，颜色变色，默认为false
    'floatHeader'=>false,//向下滚动时，标题栏可以fixed，默认为false
    'filterModel' => $searchModel,
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            'username',
            'auth_key',
            'password_hash',
            'password_reset_token',
            // 'email:email',
            // 'status',
            // 'nick_name',
            // 'real_name',
            // 'phone',
            // 'wechat_id',
            // 'wechat_name',
            // 'qq',
            // 'qq_name',
            // 'header_img',
            // 'gender',
            // 'birthday',
            // 'option:ntext',
            // 'last_login',
            // 'join_at',

            ['class' => 'yii\grid\ActionColumn','header'=>'操作'],
        ],
    ]); ?>
</div>
