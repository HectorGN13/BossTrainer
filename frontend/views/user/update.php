<?php

use kartik\password\PasswordInput;
use yii\bootstrap4\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = 'Mi perfil';


?>

<div class="user-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>


<!---->
<!---->
<!--                                                        <div class="form-group">-->
<!--                                                            --><?php
//                                                            $form = ActiveForm::begin([
//                                                                'id' => 'password-form',
//                                                                'options' => ['enctype' => 'multipart/form-data']
//                                                            ]);
//                                                            ?>
<!--                                                            --><?//= $form->field($model, 'oldPassword')->textInput()->input('password') ?>
<!---->
<!--                                                        <div class="form-group">-->
<!--                                                            --><?//= $form->field($model, 'password')->widget(PasswordInput::classname(), [
//                                                                'pluginOptions' => [
//                                                                    'showMeter' => true,
//                                                                    'toggleMask' => false,
//                                                                ]]) ?>
<!--                                                        </div>-->
<!---->
<!--                                                        <div class="form-group">-->
<!--                                                            --><?//= $form->field($model, 'passwordConfirm')->textInput()->input('password') ?>
<!--                                                        </div>-->
<!---->
<!--                                        <div class="row">-->
<!--                                            <div class="col d-flex justify-content-end">-->
<!--                                                --><?//= Html::submitButton('Guardar Cambios', ['class' => 'float-right btn btn-rounded btn-dark', 'name' => 'saveChanges-button']) ?>
<!--                                            </div>-->
<!--                                            --><?php //ActiveForm::end(); ?>
<!--                                        </div>-->
