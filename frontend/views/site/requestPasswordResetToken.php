<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\PasswordResetRequestForm */

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

$this->title = '¿Olvidaste tu contraseña?';
?>
<div class="site-request-password-reset">
    <p>No te preocupes. Introduce tu email y te enviaremos las instrucciones para recuperar tu contraseña.</p>
    <div class="row">
        <div class="col-12">
            <?php $form = ActiveForm::begin(['id' => 'request-password-reset-form']); ?>

                <?= $form->field($model, 'email')->textInput(['autofocus' => true])->input('email',  ['placeholder' => "Introduce tu correo."])->label(false) ?>

                <div class="d-flex justify-content-center form-group">
                    <?= Html::submitButton('Enviar', ['class' => 'btn btn-lg btn-rounded btn-dark']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
