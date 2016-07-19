<?php

use common\models\User;
use kartik\editable\Editable;
use yii\web\View;
use yii\helpers\Html;
use kartik\grid\GridView;
/* @var $this yii\web\View */
/* @var $searchModel common\models\UserSearchModel */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '用户管理';
$this->params['breadcrumbs'][] = $this->title;
$gridColumns =
    [
        [
            'attribute'=>'id',
            'width'=>'20px',
        ],
        [
            'attribute'=>'username',
        ],
        [
            'attribute'=>'email',
            'width'=>'200px',
            'format'=>'email',
        ],
        [
            'attribute'=>'phone',
            'width'=>'150px',
        ],
        [
            'attribute'=>'gender',
            'width'=>'150px',
            'value'=>function ($model, $key, $index, $widget) {
                if($key == 1) {
                    return '男';
                }
                else if($key == 0){
                    return '女';
                }
            },
            'filterType'=>GridView::FILTER_SELECT2,
            'filter'=>['1'=>'男','0'=>'女'],
            'filterWidgetOptions'=>[ 'pluginOptions'=>['allowClear'=>true],],
            'filterInputOptions'=>['placeholder'=>'选择性别'],
        ],
        [
            'class'=>'kartik\grid\EditableColumn',
            'attribute' => 'status',
            'value'=>function ($model, $key, $index, $widget) {
                return  User::STATUS_LABEL[$model->status];
            },
            'filterType'=>GridView::FILTER_SELECT2,
            'filter'=>User::STATUS,
            'filterWidgetOptions'=>[ 'pluginOptions'=>['allowClear'=>true],],
            'filterInputOptions'=>['placeholder'=>'选择状态'],
            'format'=>'raw',
            'width'=>'150px',
            'editableOptions'=> [
                'inputType' => Editable::INPUT_SELECT2 ,
                'options'=> ['data' =>User::STATUS],
                'formOptions' => ['action' => ['/user/default/editInline']],
            ]
        ],
        [
            'attribute'=>'last_login',
            'width'=>'250px',
            'filterType'=>GridView::FILTER_DATE ,
            'filterWidgetOptions'=>[ 'pluginOptions'=>['allowClear'=>true],],
        ],
        [
            'attribute'=>'id',
            'width'=>'100px',
            'header'=>'重置密码',
            'value'=>function ($model, $key, $index, $widget) {
                return Html::a(' <i class="fa fa-key"></i> ','javascript:void(0)',['class'=>'btn btn-sm btn-default', 'onclick'=>'resetPwd("'.$model->id.'")']);
            },
            'format'=>'raw',
            'filter'=>false,
        ],
        ['class' => '\kartik\grid\CheckboxColumn',],
    ];


$js=' 
function batchSetStatus()
{
    var keys = $("#Grid").yiiGridView("getSelectedRows");
    if($("#selecter_status").val()!="")
    {
         $.post("/user/default/batch-setstatus",{"ids":keys.join(","),"status":$("#selecter_status").val()},function(result){
            if(result.error_code==1)
            {
                location.reload();
            }
          });
    } 
}

function resetPwd()
{
    var keys = $("#Grid").yiiGridView("getSelectedRows");
    if($("#selecter_status").val()!="")
    {
         $.post("/user/ajax/reset-pwd",{"ids":keys.join(","),"status":$("#selecter_status").val()},function(result){
            if(result.error_code==1)
            {
                location.reload();
            }
          });
    } 
} 
';
$this->registerJs($js, View::POS_END);

?>
<div class="user-index">
    <?= GridView::widget([
        'id'=>'Grid',
        'panel' => [
            'footer'=>'<div class="pull-right">  
                                 修改状态 ： 
                                 <select onchange="batchSetStatus()" id="selecter_status">
                                    <option value="">请选择</option>
                                    <option value="0">待激活</option>
                                    <option value="1">已激活</option>
                                    <option value="-1">冻结</option>
                                </select> 
                        </div>',
        ],
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
