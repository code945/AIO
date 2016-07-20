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
        'authManager' => [
            'class' => 'yii\rbac\DbManager', // or use 'yii\rbac\DbManager'
        ],
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=localhost;dbname=aio',
            'username' => 'root',
            'password' => 'sqladmin945',
            'charset' => 'utf8',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.163.com',
                'username' => 'lhx880619@163.com',
                'password' => 'lhx926490',
                'port' => '994',
                'encryption' => 'ssl',
            ],
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
