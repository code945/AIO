<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use yii\web\View;

/* @var $this yii\web\View */
/* @var $searchModel common\models\CategorySearchModel */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Categories';
$this->params['breadcrumbs'][] = $this->title;
$js=' 
function batchDelete()
{
    var keys = $("#categoryGrid").yiiGridView("getSelectedRows");
     $.post("/category/batchDelete",{"ids":keys.join(",")},function(result){
        if(result.error_code==1)
        {
            $.pjax.reload({container:\'#categoryGrid-pjax\'});
        }
      });
}
';
$this->registerJs($js, View::POS_END);

?>
<div class="category-index">
 
    <?php // echo $this->render('_search', ['model' => $searchModel]);

    $gridColumns = [
        [
            'attribute'=>'id',
            'width'=>'50px',
        ],
        [
            'attribute'=>'pid',
            'width'=>'50px',
        ],
        // the name column configuration
        [
            'class'=>'kartik\grid\EditableColumn',
            'attribute'=>'name',
            'pageSummary'=>true,
            'editableOptions'=> ['formOptions' => ['action' => ['/category/editCategoty']]]
        ],
        // the buy_amount column configuration
        [
            'class'=>'kartik\grid\EditableColumn',
            'attribute'=>'sort',
            'width'=>'50px',
            'pageSummary'=>true,
            'editableOptions'=> ['formOptions' => ['action' => ['/category/editCategoty']]]
        ],
        [
            'class' => '\kartik\grid\CheckboxColumn',
        ]
    ];

    ?>





    <?= GridView::widget([
        'id' => 'categoryGrid',
        'toolbar'=> [
            ['content'=>
                Html::a('<i class="glyphicon glyphicon-plus"></i>',['create'], ['type'=>'button', 'title'=>'Add', 'class'=>'btn btn-success']).' '.
                Html::a('<i class="glyphicon glyphicon-repeat"></i>', [''], ['data-pjax'=>0, 'class'=>'btn btn-default', 'title'=>'Reset Grid'])
            ],
        ],
        'filterModel' => $searchModel, 
        'dataProvider' => $dataProvider,
        'columns' => $gridColumns ,
    ]); ?>
</div>
