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

        <?php // $form->field($model, 'id') ?>
        <?php // $form->field($model, 'name') ?>
        <?php // $form->field($model, 'address') ?>
        <?php // $form->field($model, 'email') ?>

        <?php // echo $form->field($model, 'password_hash') ?>
        <?php // echo $form->field($model, 'password_reset_token') ?>
        <?php // echo $form->field($model, 'status') ?>
        <?php // echo $form->field($model, 'created_at') ?>
        <?php // echo $form->field($model, 'updated_at') ?>
        <?php // echo $form->field($model, 'verification_token') ?>

        <div class="form-group search-form-group">
            <?=  $form->field($model, 'globalSearch')->label(false)->textInput(['placeholder' => "Buscar..."]); ?>
            <?= Html::submitButton($content, ['class' => 'float-right btn btn-dark btn-search']) ?>
        </div>
    <?php ActiveForm::end(); ?>

</div>
