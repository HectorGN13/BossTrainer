<?php
namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Material AssetBundle
 * @since 0.1
 */
class MaterialAsset extends AssetBundle
{
    public $sourcePath = '@vendor/dz0wkn/yii2-material-kit/assets';

    public $css = [
        'css/material-kit.css?v=2.0.4',
        'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css',
        'http://fonts.googleapis.com/css?family=Roboto:400,700,300|Material+Icons',
    ];

    public $js = [
        "js/plugins/moment.min.js",
        "js/core/jquery.min.js",
        "js/core/popper.min.js",
        "js/core/bootstrap-material-design.min.js",
        "js/plugins/bootstrap-datetimepicker.js",
        "js/plugins/nouislider.min.js",
        "js/plugins/jquery.sharrre.js",
        "js/material-kit.js?v=2.0.4"
    ];

    public $depends = [
    ];

}
