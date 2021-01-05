<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Paquete de archivos de la interfaz Gym.
 * Gym frontend application asset bundle.
 */
class GymsAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        'css/index.css',
        'css/gym.css',
        'css/material-kit.css',
        'css/board.css'
    ];
    public $js = [
        'js/script.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap4\BootstrapAsset',
    ];
}
