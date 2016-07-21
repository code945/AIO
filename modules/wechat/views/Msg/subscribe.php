<?php

use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Post */

$this->title = '微信关注消息';
$this->params['breadcrumbs'][] = $this->title;

$this->registerCssFile(yii\BaseYii::getAlias('@web/js/emotion/emotion.css'),['depends'=>backend\assets\AppAsset::className()]);
$this->registerJsFile( yii\BaseYii::getAlias('@web/js/emotion/emotion.js'),['depends'=>backend\assets\AppAsset::className()]);

$js=' 
        $(document).ready(function () {   
			$("#btnSubmit").click(function () {
                if ($.trim($("#content").val()).length == 0) {
                    return false;
                }
                else { 

                    $.ajax({
                        type: "POST",
                        cache: "False",
                        url: "/wechat/msg/subscribe",
                        dataType: "json",
                        data: {
                            "action": "editSubscribe",
                            "WechatMsg[content]": $("#content").val()
                        },
                        beforeSend: function (XMLHttpRequest) {

                        },
                        success: function (value) {
                            if (value.error_code == 1) {
                                alert("成功！");
                            }
                            else {
                                return false;
                            }
                        },
                        error: function (data, status, e) {
                        }
                    });


                }
            });

        });
';
$this->registerJs($js, View::POS_END);



?>

<div class="form-group">
    <label class="col-sm-3 control-label no-padding-right" for="form-field-1">自动回复内容</label>

    <div class="col-sm-9">
        <div class="txtArea">
            <div class="functionBar">
                <div class="opt">
                    <a class="icon18C iconEmotion block" href="javascript:;">表情</a>
                </div>
                <div class="tip"></div>
                <div class="emotions">
                    <table cellspacing="0" cellpadding="0">
                        <tbody>
                        </tbody>
                    </table>
                    <div class="emotionsGif"></div>
                </div>
                <div class="clr"></div>
            </div>


            <div class="editArea">
                <textarea name="content" id="content" style="display: none;" title="first tooltip"><?php echo $model->content ?> </textarea>
                <div contenteditable="true" style="overflow-y: auto; overflow-x: hidden;"></div>
            </div>
        </div>
    </div>
</div>

<div class="space-4"></div>

<div class="clearfix form-actions">
    <div class="col-md-offset-3 col-md-9">
        <button id="btnSubmit"  class="btn btn-info"  >
            <i class="icon-ok bigger-110"></i>
            提交
        </button>

        &nbsp; &nbsp; &nbsp;
        <button class="btn" type="reset">
            <i class="icon-undo bigger-110"></i>
            重置
        </button>
    </div>
</div>




