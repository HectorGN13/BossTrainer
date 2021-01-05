<?php


namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Paquete de archivos de la interfaz Movements.
 * Movements frontend application asset bundle.
 */
class MovementsAssets extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        'css/index.css',
    ];
    public $js = [
        'js/script.js',
        'js/movements.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap4\BootstrapAsset',
    ];
}