
<!--rightside start-->
<div class="col-lg-3">
    <div class="blog-side-item">
        <div class="search-row">
            <input type="text" class="form-control" placeholder="Search here">
        </div>

        <div class="category">
            <h3>文章分类</h3>
            <ul class="list-unstyled">
                <?php
                use common\helper\ContentHelper;

                foreach ($category as $item) {
                    echo '<li><a href="/?category='.$item['id'].'"><i class="  icon-angle-right"></i>  '.$item['name'].'('.$item['count'].')</a></li>';
                    }
                ?>
            </ul>
        </div>

        <div class="b">
            <h3>热门标签</h3>
            <ul class="list-unstyled tag">
                <?php
                foreach ($tags as $item) {
                    echo '<li><a href="/?tag='.$item['id'].'">'.$item['name'].'</a></li>';
                }
                ?>
            </ul>
        </div>

        <div class="archive">
            <h3>阅读排行</h3>
            <ul class="list-unstyled">
                <?php
                foreach ($posts as $item) {
                    echo '<li><a href="/post/view?id='.$item['id'].'"><i class="  icon-angle-right"></i> '.ContentHelper::cutArticle($item['title'],35).'</a></li>';
                }
                ?>
            </ul>
        </div>

<!--        <div class="blog-post">-->
<!--            <h3>最新评论</h3>-->
<!--            <div class="media">-->
<!--                <a class="pull-left" href="javascript:;">-->
<!--                    <img class=" " src="@web/img/blog/blog-thumb-1.jpg" alt="">-->
<!--                </a>-->
<!--                <div class="media-body">-->
<!--                    <h5 class="media-heading"><a href="javascript:;">2016-04-05</a></h5>-->
<!--                    <p>-->
<!--                        请问有没有YII2高级版的安装教程啊？谢谢-->
<!--                    </p>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->


    </div>
</div>
<!--rightside end-->

