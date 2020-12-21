<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Board */

$this->title = 'Nueva Pizarra';
?>
<div class="board-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
