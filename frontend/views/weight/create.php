<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Weight */

$this->title = 'Crear Peso';
?>
<div class="weight-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
