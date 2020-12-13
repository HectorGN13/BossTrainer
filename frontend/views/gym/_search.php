<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\GymSearch */
/* @var $form yii\widgets\ActiveForm */

$content = '<span class="lnr lnr-magnifier"> </span>';

?>

<div class="gym-search">


    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'class' => 'form-inline pt-3'
        ]
    ]); ?>

        <div class="form-group search-form-group">
            <?=  $form->field($model, 'globalSearch')->label(false)->textInput(['placeholder' => "Buscar..."]); ?>
            <?= Html::submitButton($content, ['class' => 'float-right btn btn-dark btn-search']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div>
