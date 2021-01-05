<?php

namespace frontend\components\navbar;

use yii\web\AssetBundle;

/**
 * Class NavSidebarAsset
 * @package frontend\components\navbar
 */
class NavSidebarAsset extends AssetBundle
{
    public $sourcePath = __DIR__ . '/assets';

    public $css = [
        'css/nav-sidebar.css'
    ];

    public $js = [
        'js/nav-sidebar.js',
    ];

    public function init()
    {
        // Tell AssetBundle where the assets files are
        $this->sourcePath = __DIR__ . DIRECTORY_SEPARATOR . 'assets';
    }
}
