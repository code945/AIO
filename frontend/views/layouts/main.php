<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use common\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use common\widgets\SideBarWidget\SideBar;


AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<?php $this->beginBody() ?>

<!--header start-->
<header class="header-frontend">
    <div class="navbar navbar-default navbar-static-top navbar-image">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/">Leo's<span> Blog</span></a>
            </div>
<!--            <div class="navbar-collapse collapse ">-->
<!--                <ul class="nav navbar-nav">-->
<!--                    <li><a href="/">首页</a></li>-->
<!--                    <li class="dropdown ">-->
<!--                        <a href="#" class="dropdown-toggle " data-toggle="dropdown" data-hover="dropdown" data-delay="0" data-close-others="false">分类 <b class=" icon-angle-down"></b></a>-->
<!--                        <ul class="dropdown-menu">-->
<!--                            <li><a href="/">NET</a></li>-->
<!--                            <li><a href="/">PHP</a></li>-->
<!--                            <li><a href="/">前端</a></li>-->
<!--                            <li><a href="/">数据库</a></li>-->
<!--                        </ul>-->
<!--                    </li>-->
<!--                    <li><a href="/">作者</a></li>-->
<!--                </ul>-->
<!--            </div>-->
        </div>
    </div>
</header>
<!--header end-->

<!--breadcrumbs start-->

<div class="breadcrumbs">
    <div class="container">
<!--        <div class="row">-->
<!--            <div class="col-lg-12 col-sm-12">-->
                <?= Breadcrumbs::widget([
                    'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                ]) ?>
<!--            </div>-->
<!--        </div>-->
    </div>
</div>
<!--breadcrumbs end-->


<!--container start-->
<div class="container">
    <div class="row">
        <!--blog start-->

        <!--left start-->
        <div class="col-lg-9 ">
            <?= Alert::widget() ?>
            <?= $content ?>
        </div>
        <!--left end-->

        <?= SideBar::widget() ?>


        <!--blog end-->
    </div>

</div>
<!--container end-->


<!--footer start-->
<footer class="footer">
    <div class="container">
                <h1 class="text-center">&copy; Leo's Blog 版权所有  | <span><i class="icon-envelope"></i> lhx880619@163.com</span></h1>
<!--                <ul class="social-link-footer list-unstyled">-->
<!--                    <li><a href="#"><i class="icon-envelope"></i></a></li>-->
<!--                    <li><a href="#"><i class="icon-github"></i></a></li>-->
<!---->
<!--                </ul>-->
    </div>
</footer>
<!--footer end-->


<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
