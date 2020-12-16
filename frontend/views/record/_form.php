<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Record */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="record-form">
    <p>Por favor, introduzca un Record. Asegúrese de que el formato es el correcto.</p>
    <div class="row">
        <div class="col-12">
        <?php $form = ActiveForm::begin(['id' => 'modalRecord', 'enableAjaxValidation' => true]); ?>

        <?= $form->field($model, 'movements_id')->textInput()->hiddenInput()->label(false) ?>

        <?= $form->field($model, 'value')->textInput(['maxlength' => true, 'autofocus' => true])->input('text',  ['placeholder' => "Introduce tu marca."])->label(false) ?>

        <div class="d-flex justify-content-center form-group">
            <?= Html::submitButton('Guardar', ['class' => 'btn btn-lg btn-rounded btn-dark']) ?>
        </div>

        <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
