<?php

namespace frontend\components\navbar;

use yii\web\AssetBundle;

class NavSidebarAsset extends AssetBundle
{
    public $sourcePath = __DIR__ . '/assets';

    public $css = [
        'css/nav-sidebar.css'
    ];

    public function init()
    {
        // Tell AssetBundle where the assets files are
        $this->sourcePath = __DIR__ . DIRECTORY_SEPARATOR . 'assets';
    }
}
