<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\datetime\DateTimePicker;
/* @var $this yii\web\View */
/* @var $model backend\models\TrainingSession */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="training-session-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput() ?>
    <?= $form->field($model, 'description')->textInput() ?>

    <?php
    echo $form->field($model, 'start_time')->widget(DateTimePicker::classname(), [
        'name' => 'start_time',
        'type' => DateTimePicker::TYPE_INPUT,
        'value' => date('d-M-Y H:i A'),
        'model' => $model,
        'pluginOptions' => [
            'autoclose'=>true,
            'format' => 'dd-M-yyyy HH:ii P'
        ]
    ]);
    ?>

    <?php
    echo $form->field($model, 'end_time')->widget(DateTimePicker::classname(), [
        'name' => 'start_time',
        'type' => DateTimePicker::TYPE_INPUT,
        'value' => date('d-M-Y H:i A'),
        'model' => $model,
        'pluginOptions' => [
            'autoclose'=>true,
            'format' => 'dd-M-yyyy HH:ii P'
        ]
    ]);
    ?>

    <?= $form->field($model, 'capacity')->textInput(['type' => 'number', 'min' => 1]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
