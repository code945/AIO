<?php

use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Post */
/* @var $form yii\widgets\ActiveForm */


$this->registerJsFile( Yii::getAlias('@web/js/categorylevel.js'),['depends'=>backend\assets\AppAsset::className()]);
backend\assets\Select2Asset::register($this);
?>

<div class="post-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>
  
    <?= $form->field($model, 'content')->widget(\yii\redactor\widgets\Redactor::className(),
        ['clientOptions' => [
            'lang' => 'zh_cn',
            'plugins' => ['clips', 'fontcolor','imagemanager']
        ]
        ]
    ) ?>


    <div class="form-group">
        <label onclick="showTags()" >Tag</label>
        <input type="hidden" id="oldtags" name="Post[oldtags]" />
        <input type="hidden" id="newtags" name="Post[newtags]" />
        <select id="tags" class="form-control" style="width: 100%;color:#444">
        </select>
    </div>

    <div class="form-group">
        <label>分类</label>
        <div class="col-xs-12">
            <div style="padding:10px; float: left;">
                <a href="javascript:void(0)" onclick="uplevel($('#post-category_id').val())" >
                    <span class="fa fa-arrow-left" ></span> 父级分类
                </a>
            </div>
            <div  style="float: left;">
                <select class="form-control left"  style="width: 200px;" name="Post[category_id]" id="post-category_id">
                </select>
            </div>
            <div style="padding:10px;float: left;">
                <a href="javascript:void(0)" onclick="downlevel($('#post-category_id').val())">
                    子级分类 <span class="fa fa-arrow-right" ></span>
                </a>
            </div>
        </div>

    </div>
 

    <?= $form->field($model, 'sort')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? '创建' : '更新', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
