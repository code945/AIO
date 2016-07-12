<?php

use yii\helpers\Html;
use kartik\grid\GridView;
/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Posts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-index">
    <?= GridView::widget([
        'panel' => [
            'heading'=>false,//不要了
            'before'=>'<div style="margin-top:8px">{summary}</div>',//放在before中，前面的div主要是想让它好看
            'after'=>false,
        ],
        'toolbar'=> [
            ['content'=>
                Html::a('<i class="glyphicon glyphicon-plus"></i>', ['create'],  ['type'=>'button', 'title'=>'Add', 'class'=>'btn btn-success', ]) . ' '.
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
        'columns' => [
            'id',
            [
                'header'=>'标题',
                "value" => function ($model) {
                    return Html::a( $model->title, "/post/view?id={$model->id}");
                },
                "format" => "raw",
            ],
            [
                'header'=>'分类',
                "value" => function ($model) {
                    return Html::a( $model->category->name, "/category/view?id={$model->category_id}", ["target" => "_blank"]);
                },
                "format" => "raw",
            ],
            'sort',
            'created_at',
            'updated_at',

            ['class' => 'yii\grid\ActionColumn','header'=>'操作'],
        ],
    ]); ?>
</div>
