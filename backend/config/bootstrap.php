<?php
use kartik\editable\Editable;
use kartik\grid\GridView;
use yii\helpers\Html;

Yii::$container->set(Editable::className(), [
    'submitButton' => [
        'class' => 'btn btn-sm btn-success',
        'icon' => '<i class="glyphicon glyphicon-ok"></i>'
    ],
    'resetButton' => [
        'class' => 'btn btn-sm btn-danger',
        'icon' => '<i class="glyphicon glyphicon-remove"></i>',
        'data-dismiss' => "popover-x"
    ]
]);


Yii::$container->set(GridView::className(), [
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
    'export'=>false,
    'resizableColumns'=>true,
    'pjax'=>true, // pjax is set to always true for this demo
    'hover'=>true,//鼠标移动上去时，颜色变色，默认为false
    'floatHeader'=>false,//向下滚动时，标题栏可以fixed，默认为false
]);