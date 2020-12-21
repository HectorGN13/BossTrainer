<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Board */

$this->title = 'Editar pizarra: ' . $model->title;

?>
<div class="board-update">
        <div class="board-list container">
            <div class="lines-effect">
                <h1 class="text-responsive" style="text-transform: uppercase"><?= Html::encode($this->title) ?></h1>
            </div>
        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>
        </div>
</div>
