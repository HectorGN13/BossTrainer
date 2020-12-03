<?php
$host = 'ec2-54-247-107-109.eu-west-1.compute.amazonaws.com';
$port = '5432';
$dbname = 'd77jse7a3aa00i';
$username = 'mrdwwkjbslmuhh';
$password = '2a4a07c860f8bf19e0d1b921561a6cbc416acc4a2626f73dbfe8cc43c528e655';
$extra = [];
return [
    'aliases' => [
        '@bower' => '@vendor/bower-asset',
        '@npm'   => '@vendor/npm-asset',
    ],
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'enableStrictParsing' => false,
            'rules' => [
                '<controller:[\w-]+>/<id:\d+>' => '<controller>/view',
            ],
        ],
        'reCaptcha3' => [
            'class'      => 'kekaadrenalin\recaptcha3\ReCaptcha',
            'site_key'   => '6LdazuUZAAAAAMP17Ct88BJ11nJSAV-jUrW9Mpjh',
            'secret_key' => '6LdazuUZAAAAAEoMt3WVZmTtZ_F67mH__j4_T9Zy',
        ],
        'db' => [
                'class' => 'yii\db\Connection',
                'dsn' => "pgsql:host=$host;port=$port;dbname=$dbname",
                'username' => $username,
                'password' => $password,
                'charset' => 'utf8',
        ] + $extra,
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'transport' => [
                'class' => 'Swift_SmtpTransport',
                'host' => 'smtp.gmail.com',
                'username' => 'bosstrainer.help@gmail.com',
                'password' => "Alba1234",
                'port' => '587',
                'encryption' => 'tls',
            ],
        ],

    ],

];
