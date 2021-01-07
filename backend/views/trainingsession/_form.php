<?php

use kartik\editors\Summernote;
use kartik\icons\FontAwesomeAsset;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\datetime\DateTimePicker;

/* @var $this yii\web\View */
/* @var $model common\models\TrainingSession */
/* @var $form yii\widgets\ActiveForm */
FontAwesomeAsset::register($this);
?>

<div class="training-session-form">
    <div class="row">
        <div class="col-12">
            <?php $form = ActiveForm::begin(); ?>

            <?php
            echo $form->field($model, 'start_time')->widget(DateTimePicker::classname(), [
                'name' => 'start_time',
                'type' => DateTimePicker::TYPE_INPUT,
                'value' => date('d-M-Y H:i A'),
                'model' => $model,
                'options' => [
                    'placeholder' => 'Introduce la hora de Inicio.',
                ],
                'pluginOptions' => [
                    'autoclose'=>true,
                    'format' => 'dd-M-yyyy HH:ii P',
                ]
            ])->label(false);
            ?>

            <?php
            echo $form->field($model, 'end_time')->widget(DateTimePicker::classname(), [
                'name' => 'start_time',
                'type' => DateTimePicker::TYPE_INPUT,
                'value' => date('d-M-Y H:i A'),
                'model' => $model,
                'options' => [
                    'placeholder' => 'Introduce la hora de Fin.',
                ],
                'pluginOptions' => [
                    'autoclose'=>true,
                    'format' => 'dd-M-yyyy HH:ii P'
                ],
            ])->label(false);
            ?>

            <?= $form->field($model, 'title')->textInput()->input('text',  ['placeholder' => "Introduce el nombre de la sesión."])->label(false) ?>
            <?= $form->field($model, 'description')->widget(Summernote::class, [
                'options' => [
                    'placeholder' => 'Edita tu pizarra aquí...',
                ]
            ])->textarea(['rows' => 10])->label(false);
            ?>

            <?= $form->field($model, 'capacity')->textInput(['type' => 'number', 'min' => 1])->input('number',  ['placeholder' => "Introduce el aforo."])->label(false) ?>

            <div class="d-flex justify-content-center form-group">
                <?= Html::submitButton('Guardar', ['class' => 'btn btn-lg btn-rounded btn-dark-blue']) ?>
            </div>

            <?php ActiveForm::end(); ?>

        </div>
    </div>
</div>
