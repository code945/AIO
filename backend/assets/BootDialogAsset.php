<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class BootDialogAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        'css/bootstrap-dialog.min.css'
    ];
    public $js = [ 
        'js/bootstrap-dialog.min.js',
    ];
    public $depends = [
        'backend\assets\AdminLteAsset'
    ];

}
