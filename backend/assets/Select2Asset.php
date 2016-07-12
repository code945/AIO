<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class Select2Asset extends AssetBundle
{
    public $sourcePath = '@vendor/almasaeed2010/adminlte/plugins/select2';//路径

    public $css = [
        '/css/select2.css',//css
    ];
    public $js = [
        'select2.min.js'//js
    ];
    public $depends = [
        'backend\assets\AdminLteAsset',//依赖关系
    ];
}