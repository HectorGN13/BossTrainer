<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\TrainingSessionSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="training-session-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'options' => [
            'class' => 'form-inline float-right mb-4'
         ],
        'method' => 'get',
    ]); ?>
    <div class="form-group">
        <?= Html::input('hidden','current_date',date('Y-m-d H:i A')) ?>
    </div>
    <div class="form-group ml-3">
    <?= Html::submitButton('Filter By Current Day', ['class' => 'btn btn-primary']) ?>
    <?= Html::a('Reset',['trainingsession/index'], ['class' => 'btn btn-outline-secondary']) ?>
    </div>
    <!-- <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'description') ?>

    <?= $form->field($model, 'start_time') ?>

    <?= $form->field($model, 'end_time') ?>

    <?= $form->field($model, 'capacity') ?> -->

    <?php // echo $form->field($model, 'created_by') ?>


    <?php ActiveForm::end(); ?>

</div>
