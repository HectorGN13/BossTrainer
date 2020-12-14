<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Record */

$this->title = 'Añadir Record: ' . $model->movements_id;

?>
<div class="record-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
