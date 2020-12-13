<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Record */

$this->title = 'Update Record: ' . $model->user_id;
$this->params['breadcrumbs'][] = ['label' => 'Records', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->user_id, 'url' => ['view', 'user_id' => $model->user_id, 'movements_id' => $model->movements_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="record-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
