<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Paquete de archivos de la interfaz Singup.
 * Singup frontend application asset bundle.
 */
class SignupAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        'css/index.css',
        'css/signup.css'
    ];
    public $js = [
        'js/script.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap4\BootstrapAsset',
    ];
}
