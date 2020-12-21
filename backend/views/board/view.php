<?php

use yii\helpers\Html;
use yii\web\YiiAsset;


/* @var $this yii\web\View */
/* @var $model backend\models\Board */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Boards', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\backend\assets\BoardAsset::register($this);
?>
<div class="container">
    <div class="board-view col-12">

        <h1><?= Html::encode($this->title) ?></h1>

        <p>
            <?= Html::a('Editar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Borrar', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => '¿Estas seguro de que quieres borrar este elemento?',
                    'method' => 'post',
                ],
            ]) ?>
        </p>

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
</div>

