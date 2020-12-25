<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\TrainingSession */

$this->title = 'Actualizar Session: ' . $model->title;

?>
<div class="training-session-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
