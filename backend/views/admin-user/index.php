<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\models\Admin;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '管理员用户';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="admin-index">
 

    <p>
        <?= Html::a('创建 管理员用户', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'id',
                'label'=>'ID'
            ],
            [
                'attribute' => 'username',
                'label'=>'用户名'
            ],
            [
                'attribute' => 'email',
                'label'=>'邮箱'
            ],
            [
                'attribute' => 'status',
                'label'=>'状态',
                'value'=>function($data){
                    return Admin::getStatusTitle($data->status);
                },
            ],
            [
                'attribute'=>'created_at',
                'format'=>['date','yyyy-MM-dd HH:mm:ss'],
                'value'=>'created_at',
                'label'=>'创建时间'
            ],
            [
                'attribute'=>'updated_at',
                'format'=>['date','yyyy-MM-dd HH:mm:ss'],
                'value'=>'updated_at',
                'label'=>'修改时间'
            ] ,
            ['class' => 'yii\grid\ActionColumn','header'=>'操作'],
        ],
    ]); ?>
</div>
