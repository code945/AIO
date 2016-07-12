<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Post */

$this->title = $model->title; 
$this->params['breadcrumbs'][] = $this->title;
?>



<div class="blog-item">

    <div class="row">
        <div class="col-lg-12 col-sm-12">
            <h1 class="no-margin"><?= $model->title ?></h1>
            <?= $model->content ?>
            <div class="alert alert-warning">
                本文由 <a href="http://www.linhongxu.com" target="_blank">Leo's Blog</a> 创作，采用 <a href="http://creativecommons.org/licenses/by-nc/2.5/cn/" target="_blank">署名-非商业性使用 2.5 中国大陆</a> 进行许可。<br>
                如需转载、引用请署名作者且注明文章出处。
            </div>
        </div>
    </div>
</div>


<div class="infopanel">
    <span class="tagspan"><i class="icon-calendar"></i> <?= date("Y年m月d日",strtotime($model->created_at) ) ?> </span>
    <span class="tagspan"><i class="icon-eye-open"></i> <?= $model->view_count ?> 浏览</span>
    <span class="tagspan"><i class="icon-comments"></i> <?= $model->comments_count ?> 评论</span>
    <?php
    $tagString='';
    foreach ($tags as $t)
    {
        if($t['post_id'] == $model->id)
        {
            $s = $tagString==''?"<span class=\"tagspan\"><i class=\"icon-tag\"></i> ":'';
            $tagString= $tagString.$s.' <a href="/?tag='.$t['tag_id'].'">'.$t['name'].'</a> ';
        }

    }
    if($tagString != '')
        $tagString= $tagString.'</span>';
    echo $tagString;
    ?>
</div>
<?php
$p = $model->getPrePost();
$n = $model->getNextPost();
if($p != null)
    echo '<a href="/post/view?id='.$p->id.'">上一篇：'.$p->title.'</a> | ';
if($n != null)
    echo '<a href="/post/view?id='.$n->id.'">下一篇：'.$n->title.'</a>';
?>
<!-- 多说评论框 start -->
<div class="ds-thread" data-thread-key="<?= $model->id ?>" data-title="<?= $model->title ?>" data-url="请替换成文章的网址"></div>
<!-- 多说评论框 end -->
<!-- 多说公共JS代码 start (一个网页只需插入一次) -->
<script type="text/javascript">
    var duoshuoQuery = {short_name:"linhongxu"};
    (function() {
        var ds = document.createElement('script');
        ds.type = 'text/javascript';ds.async = true;
        ds.src = (document.location.protocol == 'https:' ? 'https:' : 'http:') + '//static.duoshuo.com/embed.js';
        ds.charset = 'UTF-8';
        (document.getElementsByTagName('head')[0]
        || document.getElementsByTagName('body')[0]).appendChild(ds);
    })();
</script>
<!-- 多说公共JS代码 end -->


