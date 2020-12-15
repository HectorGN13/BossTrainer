<?php

use yii\helpers\Html;
use yii\web\YiiAsset;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Movements */

$this->title = $model->title;
?>
<div class="container movements-view">
    <div class="card text-center">
        <img class="card-img-top" src="<?= $model->img ?>" alt="Card image cap">
        <div class="card-body">
            <p class="card-text"><?= $model->description ?></p>
            <a href="<?= $model->video ?>" class="btn btn-dark">Ver video</a>
        </div>
    </div>
</div>
