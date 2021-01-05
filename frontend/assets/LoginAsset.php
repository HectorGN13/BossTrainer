<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Paquete de archivos de la interfaz Login.
 * Login frontend application asset bundle.
 */
class LoginAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        'css/index.css',
        'css/login.css'
    ];
    public $js = [
        'js/script.js',
        'js/login.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap4\BootstrapAsset',
    ];
}
