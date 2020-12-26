<?php

use backend\assets\BoardAsset;
use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Board */

$this->title = $model->title;
BoardAsset::register($this);
?>
<div class="board-view mt-5">
    <div class="container">
        <div id="text" class="white-board col-12">
            <?php

            $config = HTMLPurifier_Config::createDefault();
            $config->set('HTML.SafeIframe', true);
            $config->set('URI.SafeIframeRegexp', '%^(https?:)?(\/\/www\.youtube(?:-nocookie)?\.com\/embed\/|\/\/player\.vimeo\.com\/)%');
            $purifier = new HTMLPurifier($config);

            $raw = $model->body;

            echo $purifier->purify($raw)

            ?>
        </div>
    </div>
</div>

