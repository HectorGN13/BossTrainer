<?php

namespace frontend\components\parallax;


use yii\web\AssetBundle;

/**
 * Paquete de archivos para la interfaz CustomParallax
 * Class CustomParallaxAsset
 * @package frontend\components\parallax
 */
class CustomParallaxAsset extends AssetBundle
{
    public $sourcePath = __DIR__ . '/assets';

    public $js = [
        'parallax.min.js',
    ];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\web\JqueryAsset'
    ];

    public function init()
    {
        $this->sourcePath = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'assets';
    }
}
