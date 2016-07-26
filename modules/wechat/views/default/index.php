<?php

use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Post */

$this->title = '微信资源管理';
$this->params['breadcrumbs'][] = $this->title;
$this->registerCssFile('/css/img-thumbnails.css');
$this->registerCssFile('/js/colorbox/colorbox.css');
$this->registerCssFile('/js/bootstrap-fileinput/css/fileinput.css');

$this->registerJsFile('/js/layer/layer.js',['depends'=>backend\assets\AppAsset::className()]);
$this->registerJsFile('/js/colorbox/jquery.colorbox-min.js',['depends'=>backend\assets\AppAsset::className()]);
$this->registerJsFile('/js/bootstrap-fileinput/js/fileinput.min.js',['depends'=>backend\assets\AppAsset::className()]);
$js='
 var colorbox_params = {
        reposition: true,
        scalePhotos: true,
        scrolling: false,
        previous: \'<i class=\"icon-arrow-left\"></i>\',
        next: \'<i class=\"icon-arrow-right\"></i>\',
        close: "&times;",
        current: "{current} of {total}",
        maxWidth: "80%",
        maxHeight: "80%",
        onOpen: function () {
            document.body.style.overflow = "hidden";
        },
        onClosed: function () {
            document.body.style.overflow = "auto";
        },
        onComplete: function () {
            $.colorbox.resize();

        }
    }; 
    
    function showlayer()
    { 
       $(\'#modalDialog\').modal(\'show\'); 
    }
    
    
    $(document).ready(function () {
        $("#file-input").fileinput(
            {
                uploadUrl:"/file/upload",
                previewFileType:\'any\',  
            } 
        ).on(\'fileuploaded\', function(event) {
                getfiles();
                $("#tab_select").tab("show"); 
            });
         getfiles();
    });
    
    function deleteFile(btn)
    {
        var path = $(btn).attr("data-file");
         $.post("/file/delete",{"file":path},function(r){getfiles()});
    } 
    
    function getfiles()
    {
        $.get("/file/list",function(r){
            $("#img-thumbnails").empty();
            $.each(r.list,function(idx,item){
                $("#img-thumbnails").append(
                    \'<li>\'
                    +\'    <a href="\'+item+\'"  data-rel="colorbox" title="Photo Title" >\'
                    +\'        <img width="150" height="150" alt="150x150"   src="\'+item+\'">\'
                    +\'    </a>\'
                    +\'    <div class="tools tools-bottom"> \'
                    +\'        <a href="#">\'
                    +\'            <i class="fa fa-pencil"></i>\'
                    +\'        </a>\' 
                    +\'        <a href="#" data-file="\'+item+\'" onclick="deleteFile(this)">\'
                    +\'            <i class="fa fa-times red"></i>\'
                    +\'        </a>\'
                    +\'    </div>\'
                    +\'</li>\'
                    );
            })
            $(".img-thumbnails [data-rel=\"colorbox\"]").colorbox(colorbox_params);
        })
    }
    
 
';
$this->registerJs($js, View::POS_END);

?>
<div>
    <button onclick="showlayer();">show layer</button>


    <div id="modalDialog" class="modal">
        <div class="modal-dialog" style="width: 850px; height: 600px;">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">资源管理</h4>
                </div>
                <div class="modal-body"  >

                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li class="active" ><a href="#select" id="tab_select" data-toggle="tab" >选取图片</a></li>
                            <li ><a href="#upload" data-toggle="tab" id="tab_upload">上传新图</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="active tab-pane" id="select">
                                <ul id="img-thumbnails" class="img-thumbnails clearfix">

                                </ul>
                            </div>
                            <!-- /.tab-pane -->
                            <div class="tab-pane" id="upload">
                                <input id="file-input" name="file-input" type="file" multiple  >
                            </div>
                            <!-- /.tab-pane -->
                        </div>
                        <!-- /.tab-content -->
                    </div>



                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->






</div>