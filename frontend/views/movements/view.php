<?php

use yii\helpers\Html;
use yii\web\YiiAsset;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Movements */

$this->title = $model->title;
YiiAsset::register($this);
?>
<div class="container movements-view">
    <div class="card" style="width: 18rem;">
        <img class="card-img-top" src="<?= $model->img ?>" alt="Card image cap">
        <div class="card-body">
            <h5 class="card-title"><?= $model->title ?></h5>
            <p class="card-text"><?= $model->description ?></p>
            <a href="<?= $model->video ?>" class="btn btn-dark">Ver video</a>
        </div>
    </div>
</div>
