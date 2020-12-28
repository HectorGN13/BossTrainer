<?php

use kartik\editors\Summernote;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\icons\FontAwesomeAsset;

/* @var $this yii\web\View */
/* @var $model common\models\Board */
/* @var $form yii\widgets\ActiveForm */
FontAwesomeAsset::register($this);
?>

<div class="board-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'body')->widget(Summernote::class, [
        'options' => [
                'placeholder' => 'Edita tu pizarra aquí...',
            ]
    ])->textarea(['rows' => 15]);
    ?>

    <div class="form-group">
        <?= Html::submitButton('Añadir', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
