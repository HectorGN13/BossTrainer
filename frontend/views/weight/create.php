<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\Weight */

$this->title = 'Create Weight';
$this->params['breadcrumbs'][] = ['label' => 'Weights', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="weight-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
