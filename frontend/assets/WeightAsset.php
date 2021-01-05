<?php


namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Paquete de archivos de la interfaz Weight.
 * Weight frontend application asset bundle.
 */
class WeightAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        'css/index.css',
    ];
    public $js = [
        'js/script.js',
        'js/weight.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap4\BootstrapAsset',
    ];
}