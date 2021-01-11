<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Paquete de archivos de la interfaz principal de la aplicación.
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        'css/index.css',
        'css/cookie-consent',
    ];
    public $js = [
        'js/script.js',
        'js/main.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap4\BootstrapAsset',
        'yii\bootstrap4\BootstrapPluginAsset',
        'simialbi\yii2\animatecss\AnimateCssPluginAsset',
    ];
}
