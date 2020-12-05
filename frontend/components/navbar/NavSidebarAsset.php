<?php

namespace frontend\components\navbar;

use yii\web\AssetBundle;

/**
 * Include the CSS and JavaScript files in the bundle
 * 
 * @author: Leonard Shtika <leonard@shtika.info>
 */
class NavSidebarAsset extends AssetBundle
{
    public $css = [
        'css/nav-sidebar.css'
    ];

    public $js = [
        'js/main.js',
    ];

    public function init()
    {
        // Tell AssetBundle where the assets files are
        $this->sourcePath = __DIR__ . DIRECTORY_SEPARATOR . 'assets';
        parent::init();
    }
}
