<?php
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
                // ...
            ],
        ],
        'reCaptcha3' => [
            'class'      => 'kekaadrenalin\recaptcha3\ReCaptcha',
            'site_key'   => '6LdazuUZAAAAAMP17Ct88BJ11nJSAV-jUrW9Mpjh',
            'secret_key' => '6LdazuUZAAAAAEoMt3WVZmTtZ_F67mH__j4_T9Zy',
        ],

    ],
];
