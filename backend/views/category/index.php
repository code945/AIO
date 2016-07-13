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
        'panel' => [
            'heading'=>false,//不要了
            'before'=>'<div style="margin-top:8px">{summary}</div>',//放在before中，前面的div主要是想让它好看
            'after'=>false,
            'footer'=>'<div class="pull-right"><a href="javascript:void(0);" onclick="batchDelete();" class="btn btn-danger"><i class="glyphicon glyphicon-trash"></i> 批量删除</a></div>',
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
        'columns' => $gridColumns ,
    ]); ?>
</div>
