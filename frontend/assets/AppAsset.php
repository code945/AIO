<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
    "css/bootstrap.min.css",
    "css/theme.css",
    "css/bootstrap-reset.css",
    "assets/font-awesome/css/font-awesome.css",
    "css/flexslider.css",
    "assets/bxslider/jquery.bxslider.css",
    "css/style.css",
    "css/style-responsive.css",
    ];
    public $js = [
    "js/jquery.js",
    "js/bootstrap.min.js",
    "js/hover-dropdown.js",
    "js/jquery.flexslider.js",
    "assets/bxslider/jquery.bxslider.js",
    "js/jquery.easing.min.js",
    "js/link-hover.js",
    "js/jquery.scrollUp.min.js",
    "js/common-scripts.js",
    ];
    public $depends = [

    ];
}
