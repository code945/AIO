<?php

/* @var $this yii\web\View */
use yii\widgets\LinkPager;
use yii\widgets\ListView;
$this->title = 'Leo\'s Blog';
//$this->registerJsFile( yii\BaseYii::getAlias('@web').'js/blogs.js',['depends'=>frontend\assets\AppAsset::className()]);

?>




<div class="row" >
<!--    <div id="spinner" class="loader">Loading...</div>-->

    <div id="posts" >
        <?php
        foreach ($model as $item) {

            $tagString='';
            foreach ($tags as $t)
            {
                if($t['post_id'] == $item->id)
                {
                    $s = $tagString==''?"<span class=\"tagspan\"><i class=\"icon-tag\"></i> ":',';
                    $tagString= $tagString.$s.' <a href="/?tag='.$t['tag_id'].'">'.$t['name'].'</a> ';
                }

            }
            if($tagString != '')
                $tagString= $tagString.'</span>';
            $row =
                ' <div class="blog-item">'
                .'     <div class="row">'
                .'     <div class="col-lg-2 col-sm-2 showDesk text-right">'
                .'          <div class="date-wrap">'
                .'              <span class="date">'.date("d日",strtotime($item->created_at) ).'</span>'
                .'              <span class="month">'. date("Y年m月",strtotime($item->created_at) ).'</span>'
                .'          </div>'
                .'          <div class="author">'
                .'              By <a href="#">Leo</a>'
                .'          </div>'
                .'     </div>'
                .'     <div class="col-lg-10 col-sm-10">'
                .'     <h1 class="no-margin"><a href="/post/view?id='.$item->id.'">'.$item->title.'</a></h1>'
                .' <p>'.common\helper\ContentHelper::cutArticle($item->content,500).' <a href="/post/view?id='.$item->id.'" >[继续阅读]</a>'.'</p>'
                .' <div class="infopanel">'
                .'     <span class="tagspan"><i class="icon-eye-open"></i> '.$item->view_count.' 浏览</span>'
                .'     <span class="tagspan"><i class="icon-comments"></i> '.$item->comments_count.' 评论</span>'
                .'     '.$tagString.''
                .' </div>'
                .'     </div>'
                .'     </div>'
                .'     </div>';
            echo $row;
        }
        ?>


    </div>
</div>

<div class="text-center">
    <?= LinkPager::widget(['pagination' => $pages]); ?>
</div>