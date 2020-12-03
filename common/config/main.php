<?php
$host = '127.0.0.1';
$port = '5433';
$dbname = 'BossTrainer';
$username = 'postgres';
$password = 'alba1234';
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
