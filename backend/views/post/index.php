<?php

use kartik\editable\Editable;
use yii\helpers\Html;
use kartik\grid\GridView;
use yii\web\View;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Posts';
$this->params['breadcrumbs'][] = $this->title;
$js=' 
function batchDelete()
{
    var keys = $("#Grid").yiiGridView("getSelectedRows");
     $.post("/post/batchDelete",{"ids":keys.join(",")},function(result){
        if(result.error_code==1)
        {
            $.pjax.reload({container:\'#Grid-pjax\'});
        }
      });
}
';
$this->registerJs($js, View::POS_END);
?>
<div class="post-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]);

    $gridColumns =
        [
            [
                'attribute'=>'id',
                'width'=>'50px',
            ],
            [
                'class'=>'kartik\grid\EditableColumn',
                'header'=>'标题',
                'attribute'=>'title',
                'pageSummary'=>true,
                'editableOptions'=> ['formOptions' => ['action' => ['/post/editInline']]]
            ],
            [
                'header'=>'分类',
                'class'=>'kartik\grid\EditableColumn',
                'attribute' => 'category_id',
                'value' => 'category.name',
                'editableOptions'=> [
                    'inputType' => Editable::INPUT_SELECT2 ,
                    'options'=>
                    [
                        'data' =>\common\models\Category::getItems(),
                    ],
                    'pluginEvents' => [
                        "editableSuccess"=>"function(event, val, form, data) { console.log('Successful submission of value ' + val); }",
                    ]
                   ,

                    'formOptions' => ['action' => ['/post/editInline']],
                ]
            ],
            [
                'class'=>'kartik\grid\EditableColumn',
                'attribute'=>'sort',
                'width'=>'50px',
                'pageSummary'=>true,
                'editableOptions'=> ['formOptions' => ['action' => ['/post/editInline']]]
            ],
            [
                'attribute'=>'created_at',
                'width'=>'50px',
            ],
            [
                'attribute'=>'updated_at',
                'width'=>'50px',
            ],
            ['class' => 'yii\grid\ActionColumn','header'=>'操作'],
            ['class' => '\kartik\grid\CheckboxColumn',],
        ];

    ?>
    
    <?= GridView::widget([
        'id'=>'Grid',
        'toolbar'=> [
            ['content'=>
                Html::a('<i class="glyphicon glyphicon-plus"></i>', ['create'],  ['type'=>'button','data-pjax'=>0, 'title'=>'Add', 'class'=>'btn btn-success', ]) . ' '.
                Html::a('<i class="glyphicon glyphicon-repeat"></i>', [''], ['data-pjax'=>0, 'class'=>'btn btn-default', 'title'=>'Reset Grid'])
            ],
        ],
        'filterModel' => $searchModel,
        'dataProvider' => $dataProvider,
        'columns' => $gridColumns
    ]); ?>
</div>
