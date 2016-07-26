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
    
    $(".img-thumbnails [data-rel=\"colorbox\"]").colorbox(colorbox_params);
    
    function showlayer()
    { 
       $(\'#modalDialog\').modal(\'show\'); 
    }
    
    
    $(document).ready(function () {
        $("#file-input").fileinput(
        {
            uploadUrl:"/upload",
            previewFileType:\'any\',  
            overwriteInitial:false, 
        }
        
        );
    });
 
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
                            <li class="active"><a href="#select" data-toggle="tab">选取图片</a></li>
                            <li><a href="#upload" data-toggle="tab">上传新图</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="active tab-pane" id="select">
                                <ul id="img-thumbnails" class="img-thumbnails clearfix">
                                    <li>
                                        <a href="/images/login-bg.jpg"  data-rel="colorbox" title="Photo Title" >
                                            <img width="150" height="150" alt="150x150"   src="/images/login-bg.jpg">
                                        </a>
                                        <div class="tools tools-bottom">
                                            <a href="#">
                                                <i class="fa fa-link"></i>
                                            </a>

                                            <a href="#">
                                                <i class="fa fa-paperclip"></i>
                                            </a>

                                            <a href="#">
                                                <i class="fa fa-pencil"></i>
                                            </a>

                                            <a href="#">
                                                <i class="fa fa-times red"></i>
                                            </a>
                                        </div>
                                    </li>
                                    <li>
                                        <a href="/images/login-bg.jpg"  data-rel="colorbox" title="Photo Title2" >
                                            <img width="150" height="150" alt="150x150"   src="/images/login-bg.jpg">
                                        </a>
                                        <div class="tools tools-bottom">
                                            <a href="#">
                                                <i class="fa fa-link"></i>
                                            </a>

                                            <a href="#">
                                                <i class="fa fa-paperclip"></i>
                                            </a>

                                            <a href="#">
                                                <i class="fa fa-pencil"></i>
                                            </a>

                                            <a href="#">
                                                <i class="fa fa-times red"></i>
                                            </a>
                                        </div>
                                    </li>
                                    <li>
                                        <a href="/images/login-bg.jpg"  data-rel="colorbox" title="Photo Title" >
                                            <img width="150" height="150" alt="150x150"   src="/images/login-bg.jpg">
                                        </a>
                                        <div class="tools tools-bottom">
                                            <a href="#">
                                                <i class="fa fa-link"></i>
                                            </a>

                                            <a href="#">
                                                <i class="fa fa-paperclip"></i>
                                            </a>

                                            <a href="#">
                                                <i class="fa fa-pencil"></i>
                                            </a>

                                            <a href="#">
                                                <i class="fa fa-times red"></i>
                                            </a>
                                        </div>
                                    </li>
                                    <li>
                                        <a href="/images/login-bg.jpg"  data-rel="colorbox" title="Photo Title2" >
                                            <img width="150" height="150" alt="150x150"   src="/images/login-bg.jpg">
                                        </a>
                                        <div class="tools tools-bottom">
                                            <a href="#">
                                                <i class="fa fa-link"></i>
                                            </a>

                                            <a href="#">
                                                <i class="fa fa-paperclip"></i>
                                            </a>

                                            <a href="#">
                                                <i class="fa fa-pencil"></i>
                                            </a>

                                            <a href="#">
                                                <i class="fa fa-times red"></i>
                                            </a>
                                        </div>
                                    </li>
                                    <li>
                                        <a href="/images/login-bg.jpg"  data-rel="colorbox" title="Photo Title" >
                                            <img width="150" height="150" alt="150x150"   src="/images/login-bg.jpg">
                                        </a>
                                        <div class="tools tools-bottom">
                                            <a href="#">
                                                <i class="fa fa-link"></i>
                                            </a>

                                            <a href="#">
                                                <i class="fa fa-paperclip"></i>
                                            </a>

                                            <a href="#">
                                                <i class="fa fa-pencil"></i>
                                            </a>

                                            <a href="#">
                                                <i class="fa fa-times red"></i>
                                            </a>
                                        </div>
                                    </li>
                                    <li>
                                        <a href="/images/login-bg.jpg"  data-rel="colorbox" title="Photo Title2" >
                                            <img width="150" height="150" alt="150x150"   src="/images/login-bg.jpg">
                                        </a>
                                        <div class="tools tools-bottom">
                                            <a href="#">
                                                <i class="fa fa-link"></i>
                                            </a>

                                            <a href="#">
                                                <i class="fa fa-paperclip"></i>
                                            </a>

                                            <a href="#">
                                                <i class="fa fa-pencil"></i>
                                            </a>

                                            <a href="#">
                                                <i class="fa fa-times red"></i>
                                            </a>
                                        </div>
                                    </li>
                                    <li>
                                        <a href="/images/login-bg.jpg"  data-rel="colorbox" title="Photo Title" >
                                            <img width="150" height="150" alt="150x150"   src="/images/login-bg.jpg">
                                        </a>
                                        <div class="tools tools-bottom">
                                            <a href="#">
                                                <i class="fa fa-link"></i>
                                            </a>

                                            <a href="#">
                                                <i class="fa fa-paperclip"></i>
                                            </a>

                                            <a href="#">
                                                <i class="fa fa-pencil"></i>
                                            </a>

                                            <a href="#">
                                                <i class="fa fa-times red"></i>
                                            </a>
                                        </div>
                                    </li>
                                    <li>
                                        <a href="/images/login-bg.jpg"  data-rel="colorbox" title="Photo Title2" >
                                            <img width="150" height="150" alt="150x150"   src="/images/login-bg.jpg">
                                        </a>
                                        <div class="tools tools-bottom">
                                            <a href="#">
                                                <i class="fa fa-link"></i>
                                            </a>

                                            <a href="#">
                                                <i class="fa fa-paperclip"></i>
                                            </a>

                                            <a href="#">
                                                <i class="fa fa-pencil"></i>
                                            </a>

                                            <a href="#">
                                                <i class="fa fa-times red"></i>
                                            </a>
                                        </div>
                                    </li>
                                    <li>
                                        <a href="/images/login-bg.jpg"  data-rel="colorbox" title="Photo Title" >
                                            <img width="150" height="150" alt="150x150"   src="/images/login-bg.jpg">
                                        </a>
                                        <div class="tools tools-bottom">
                                            <a href="#">
                                                <i class="fa fa-link"></i>
                                            </a>

                                            <a href="#">
                                                <i class="fa fa-paperclip"></i>
                                            </a>

                                            <a href="#">
                                                <i class="fa fa-pencil"></i>
                                            </a>

                                            <a href="#">
                                                <i class="fa fa-times red"></i>
                                            </a>
                                        </div>
                                    </li>
                                    <li>
                                        <a href="/images/login-bg.jpg"  data-rel="colorbox" title="Photo Title2" >
                                            <img width="150" height="150" alt="150x150"   src="/images/login-bg.jpg">
                                        </a>
                                        <div class="tools tools-bottom">
                                            <a href="#">
                                                <i class="fa fa-link"></i>
                                            </a>

                                            <a href="#">
                                                <i class="fa fa-paperclip"></i>
                                            </a>

                                            <a href="#">
                                                <i class="fa fa-pencil"></i>
                                            </a>

                                            <a href="#">
                                                <i class="fa fa-times red"></i>
                                            </a>
                                        </div>
                                    </li>
                                    <li>
                                        <a href="/images/login-bg.jpg"  data-rel="colorbox" title="Photo Title" >
                                            <img width="150" height="150" alt="150x150"   src="/images/login-bg.jpg">
                                        </a>
                                        <div class="tools tools-bottom">
                                            <a href="#">
                                                <i class="fa fa-link"></i>
                                            </a>

                                            <a href="#">
                                                <i class="fa fa-paperclip"></i>
                                            </a>

                                            <a href="#">
                                                <i class="fa fa-pencil"></i>
                                            </a>

                                            <a href="#">
                                                <i class="fa fa-times red"></i>
                                            </a>
                                        </div>
                                    </li>
                                    <li>
                                        <a href="/images/login-bg.jpg"  data-rel="colorbox" title="Photo Title2" >
                                            <img width="150" height="150" alt="150x150"   src="/images/login-bg.jpg">
                                        </a>
                                        <div class="tools tools-bottom">
                                            <a href="#">
                                                <i class="fa fa-link"></i>
                                            </a>

                                            <a href="#">
                                                <i class="fa fa-paperclip"></i>
                                            </a>

                                            <a href="#">
                                                <i class="fa fa-pencil"></i>
                                            </a>

                                            <a href="#">
                                                <i class="fa fa-times red"></i>
                                            </a>
                                        </div>
                                    </li>
                                    <li>
                                        <a href="/images/login-bg.jpg"  data-rel="colorbox" title="Photo Title" >
                                            <img width="150" height="150" alt="150x150"   src="/images/login-bg.jpg">
                                        </a>
                                        <div class="tools tools-bottom">
                                            <a href="#">
                                                <i class="fa fa-link"></i>
                                            </a>

                                            <a href="#">
                                                <i class="fa fa-paperclip"></i>
                                            </a>

                                            <a href="#">
                                                <i class="fa fa-pencil"></i>
                                            </a>

                                            <a href="#">
                                                <i class="fa fa-times red"></i>
                                            </a>
                                        </div>
                                    </li>
                                    <li>
                                        <a href="/images/login-bg.jpg"  data-rel="colorbox" title="Photo Title2" >
                                            <img width="150" height="150" alt="150x150"   src="/images/login-bg.jpg">
                                        </a>
                                        <div class="tools tools-bottom">
                                            <a href="#">
                                                <i class="fa fa-link"></i>
                                            </a>

                                            <a href="#">
                                                <i class="fa fa-paperclip"></i>
                                            </a>

                                            <a href="#">
                                                <i class="fa fa-pencil"></i>
                                            </a>

                                            <a href="#">
                                                <i class="fa fa-times red"></i>
                                            </a>
                                        </div>
                                    </li>
                                    <li>
                                        <a href="/images/login-bg.jpg"  data-rel="colorbox" title="Photo Title" >
                                            <img width="150" height="150" alt="150x150"   src="/images/login-bg.jpg">
                                        </a>
                                        <div class="tools tools-bottom">
                                            <a href="#">
                                                <i class="fa fa-link"></i>
                                            </a>

                                            <a href="#">
                                                <i class="fa fa-paperclip"></i>
                                            </a>

                                            <a href="#">
                                                <i class="fa fa-pencil"></i>
                                            </a>

                                            <a href="#">
                                                <i class="fa fa-times red"></i>
                                            </a>
                                        </div>
                                    </li>



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