<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'bootstrap' => ['log','admin'],
    'modules' => [
        'user' =>  [
            'class' => 'modules\user\Module', 
        ],
        'redactor' => [
            'class' => 'yii\redactor\RedactorModule',
            'uploadDir' => __DIR__ .'/../../uploads',
            'uploadUrl' => 'http://static.yii2blog.com',
            'imageAllowExtensions'=>['jpg','png','gif'],

         ],
        'gridview' =>  [
            'class' => '\kartik\grid\Module', 
            // enter optional module parameters below - only if you need to
            // use your own export download action or custom translation
            // message source
            // 'downloadAction' => 'gridview/export/download',
            // 'i18n' => []
        ],
        "admin" => [
            'class' => 'mdm\admin\Module',
            'layout' => '@backend/views/layouts/main'
        ],
    ],
    'aliases' => [
        '@uploads' => '/path/to/foo',
        "@mdm/admin" => "@vendor/mdmsoft/yii2-admin",
    ],
    'language'=>'zh-CN',
    'components' => [

        'user' => [
            'identityClass' => 'backend\models\Admin',
            'enableAutoLogin' => true,
            'identityCookie' => [
                'name' => '_backendUser', // unique for frontend
            ]
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        "authManager" => [
            "class" => 'yii\rbac\DbManager', //这里记得用单引号而不是双引号
            "defaultRoles" => ["guest"],
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                "<controller:\w+>/<id:\d+>"=>"<controller>/view",
                "<controller:\w+>/<action:\w+>"=>"<controller>/<action>"
            ],
        ],
    ],
    'as access' => [
        //ACF肯定是要加的，因为粗心导致该配置漏掉了，很是抱歉
        'class' => 'mdm\admin\classes\AccessControl',
        'allowActions' => [
            //这里是允许访问的action
            //controller/action
            '/site/login',
            'site/captcha',
            '/site/logout',
            '/site/error'
        ]
    ],
    'params' => $params,
];
