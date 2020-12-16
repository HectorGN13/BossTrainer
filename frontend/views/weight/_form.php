<?php

use kartik\date\DatePicker;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\Weight */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="weight-form">
    <p>Por favor, introduzca un nuevo Registro.</p>
    <div class="row">
        <div class="col-12 d-inline-block">
        <?php $form = ActiveForm::begin(['id' => 'modalRecord', 'enableAjaxValidation' => true]); ?>

        <?= $form->field($model, 'value')->textInput()->input('number',  ['placeholder' => "Introduce un registro."])->label(false) ?>

        <?= $form->field($model, 'create_at')->widget(DatePicker::classname(), [
            'options' => ['placeholder' => 'Fecha del registro.'],
            'language' => 'es',
            'type' => DatePicker::TYPE_COMPONENT_APPEND,
            'pluginOptions' => [
                'autoclose'=>true,
                'format' => 'yyyy-m-d',
            ]
        ])->label(false);?>

        <div class="d-flex justify-content-center form-group">
            <?= Html::submitButton('Guardar', ['class' => 'btn btn-lg btn-rounded btn-dark']) ?>
        </div>

        <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>

