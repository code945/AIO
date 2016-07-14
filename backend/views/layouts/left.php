<?php
use mdm\admin\classes\MenuHelper;
use yii\helpers\Html;

$callback = function($menu){
    $data = json_decode($menu['data'], true);
    $items = $menu['children'];
    $return = [
        'label' => $menu['name'],
        'url' => [$menu['route']],
    ];
    //处理我们的配置
    if ($data) {
        //visible
        isset($data['visible']) && $return['visible'] = $data['visible'];
        //icon
        isset($data['icon']) && $data['icon'] && $return['icon'] = $data['icon'];
        //other attribute e.g. class...
        $return['options'] = $data;
    }
    //没配置图标的显示默认图标
    (!isset($return['icon']) || !$return['icon']) && $return['icon'] = 'fa fa-circle-o';
    $items && $return['items'] = $items;
    return $return;
};

?>
<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?= $directoryAsset ?>/img/user2-160x160.jpg"  class="img-circle"   alt="User Image" />
            </div>
            <div class="pull-left info">

                <!-- Status -->
                <?php
                if(!Yii::$app->user->isGuest)
                    echo  '<p>'.Yii::$app->user->identity->username.'</p>'.
                    Html::a(
                        '<i class=" fa fa-power-off"></i> 登出',
                        ['/site/logout'],
                        ['data-method' => 'post', 'class' => 'text-red']
                    ). '<a href="/admin-user/chpwd" class="text-green"><i class=" fa fa-key"></i>改密</a>';
                else
                    echo
                        Html::a(
                            '<i class=" fa fa-key"></i> 登陆',
                            ['/site/login'],
                            ['data-method' => 'post', 'class' => 'text-green']
                        )

                ?>

            </div>
        </div>


        <?= backend\components\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu'],
                'items' => MenuHelper::getAssignedMenu(Yii::$app->user->id,null,$callback),
//                    [
//                        ['label' => '菜单选项', 'options' => ['class' => 'header'], 'visible' => !Yii::$app->user->isGuest],
//                        ['label' => '管理员用户','icon' => 'fa fa-gear', 'url' => ['admin-user/'], 'visible' => !Yii::$app->user->isGuest],
//                        ['label' => '分类管理','icon' => 'fa fa-bars', 'url' => ['category/'], 'visible' => !Yii::$app->user->isGuest],
//                        ['label' => 'Tag管理','icon' => 'fa fa-tag', 'url' => ['tag/'], 'visible' => !Yii::$app->user->isGuest],
//                        ['label' => '文章管理','icon' => 'fa fa-file', 'url' => ['post/'], 'visible' => !Yii::$app->user->isGuest],
//                        [
//                            'label' => '微信',
//                            'icon' => 'fa fa-wechat',
//                            'url' => '#',
//                            'visible' => !Yii::$app->user->isGuest,
//                            'items' => [
//                                ['label' => '菜单', 'icon' => 'fa fa-list', 'url' => ['wechat/menu'],],
//                                [
//                                    'label' => '消息回复',
//                                    'icon' => 'fa fa-envelope',
//                                    'url' => '#',
//                                    'items' => [
//                                        ['label' => '欢迎语', 'icon' => 'fa fa-flag', 'url' => '#',],
//                                        ['label' => '文本消息', 'icon' => 'fa fa-font', 'url' => '#',],
//                                        ['label' => '图文消息', 'icon' => 'fa fa-image', 'url' => '#',],
//                                    ],
//                                ],
//                            ],
//                        ],
//                    ],
            ]
        ) ?>

    </section>

</aside>
