<?php
return [
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'aliases' => [
        '@frontendUrl' => 'http://www.linhongxu.com',
        '@backendUrl' => 'http://admin.linhongxu.com',
        '@authQRCodeUrl' => '@frontendUrl/wechat/auth-qr/',
        '@authRequestUrl' => '@frontendUrl/wechat/auth-request',
        '@authCallbackUrl' => '@frontendUrl/wechat/auth-callback',
        '@wechatQrTimer' => '30000',
    ],
    'components' => [
		'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=blog',
            'username' => 'root',
            'password' => 'sqladmin945',
            'charset' => 'utf8',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'redis' => [
            'class' => 'yii\redis\Connection',
            'hostname' => '127.0.0.1',
            'port' => 6379,
            'database' => 0,
        ],
    ],
];
