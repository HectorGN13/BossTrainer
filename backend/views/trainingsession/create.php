<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\TrainingSession */

$this->title = 'Crear sesión de entrenamiento.';
?>
<div class="training-session-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
