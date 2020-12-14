<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Record */

$this->title = 'Modificar Record: ' . $model->movements_id;

?>
<div class="record-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
