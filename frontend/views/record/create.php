<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Record */

$this->title = 'Crear Record';
?>
<div class="record-create">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>
