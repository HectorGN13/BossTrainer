<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Movements */

$this->title = 'Create Movements';
$this->params['breadcrumbs'][] = ['label' => 'Movements', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="movements-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
