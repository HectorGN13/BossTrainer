<?php

use kartik\password\PasswordInput;
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form container pt-5">
        <h1 class="py-4"><?= Html::encode($this->title) ?></h1>
        <div class="col">
            <div class="row">
                <div class="col mb-3">
                    <div class="card">
                        <div class="card-body">
                            <div class="e-profile">
                                <div class="row">
                                    <div class="col-12 col-sm-auto mb-3">
                                        <div class="mx-auto" style="width: 140px;">
                                            <div class="d-flex justify-content-center align-items-center rounded" style="height: 140px; background-color: rgb(233, 236, 239);">
                                                <span style="color: rgb(166, 168, 170); font: bold 8pt Arial;">140x140</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col d-flex flex-column flex-sm-row justify-content-between mb-3">
                                        <div class="text-center text-sm-left mb-2 mb-sm-0">
                                            <h4 class="pt-sm-2 pb-1 mb-0 text-nowrap"><?= (isset($model->name) && !empty($model->name)) ? Html::encode($model->name) : "Todavía no tienes nombre" ?></h4>
                                            <p class="mb-0"><?= $model->username ?></p>
                                            <div class="mt-2">
                                                <button class="btn btn-rounded btn-dark" type="button">
                                                    <i class="fa fa-fw fa-camera"></i>
                                                    <span>Cambiar Foto</span>
                                                </button>
                                            </div>
                                        </div>
                                        <div class="text-center text-sm-right">
                                            <?php
                                            if( $model->status == 10) {
                                                echo Html::tag('span','Registrado' , ['class' => 'badge badge-success']);
                                            } else {
                                                echo Html::tag('span','No registrado' , ['class' => 'badge badge-secondary']);
                                            }
                                            ?>
                                            <div class="text-muted"><small><?= Yii::$app->formatter->format($model->created_at, 'date'); ?></small></div>
                                        </div>
                                    </div>
                                </div>
                                <ul class="nav nav-tabs">
                                    <li class="nav-item"><a href="" class="active nav-link">Configuración</a></li>
                                </ul>
                                <div class="tab-content pt-3">
                                    <div class="tab-pane active">

                                        <?php $form = ActiveForm::begin(); ?>

                                        <div class="row">
                                            <div class="col">
                                                <div class="row">
                                                    <div class="col">

<!--                                                    --><?//= $form->field($model, 'name')->textInput(['maxlength' => true])->input('text', ['placeholder' =>
//                                                        (isset($model->name) && !empty($model->name)) ? Html::encode($model->name) : "Escríbe tu nombre completo." ]) ?>

                                                    </div>
                                                    <div class="col">

                                                    <?= $form->field($model, 'username')->textInput(['maxlength' => true,  'disabled' => 'true']) ?>

                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">

                                                    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col mb-3">

                                                    <?= $form->field($model, 'bio')->textarea(['rows' => '6', 'placeholder'=>
                                                        (isset($model->bio) && !empty($model->bio)) ? Html::encode($model->bio) : "Cuéntanos algo sobre ti." ])->hint('0/320 Caracteres.') ?>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-12 col-sm-6 mb-3">
                                                <div class="mb-2"><b>Cambiar contraseña</b></div>
                                                <div class="row">
                                                    <div class="col">
                                                        <?= $form->field($model, 'oldPassword')->textInput()->input('password') ?>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <?= $form->field($model, 'password')->
                                                        widget(PasswordInput::classname(), [
                                                                'pluginOptions' => [
                                                                        'showMeter' => true,
                                                                    'toggleMask' => false,
                                                                ]]) ?>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col">
                                                        <?= $form->field($model, 'passwordConfirm')->textInput()->input('password') ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <?= Html::submitButton('Guardar Cambios', ['class' => 'float-right btn btn-rounded btn-dark']) ?>
                                        </div>

                                        <?php ActiveForm::end(); ?>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>