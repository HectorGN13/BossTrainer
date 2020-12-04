<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap4\ActiveForm */
/* @var $model \frontend\models\ResetPasswordForm */

use kartik\password\PasswordInput;
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

$this->title = 'Restablecer contraseña';
?>
<div class="site-reset-password">
    <div class="container mt-5">
        <div class="row pt-5">
            <div class="col-lg-5 pt-3">
                <h4 class="pb-2">¿Tienes problemas para inciar sesión?</h4>
                <p>Estás a un solo paso de restablecer tu contraseña: </p>
                <p>Introduce tu nueva contraseña, recuerda que debe tener al menos una mayúscula y un dígito. </p>
            </div>
            <div class="col-lg-5 special-border" style="border: 1px solid #ccc;background-color: #fafafa; padding-bottom: 20px;">
                <?php $form = ActiveForm::begin(['id' => 'reset-password-form']); ?>
                <h3 style="background-color:#fafafa; margin-bottom: 20px; margin-top: 20px; ">Restablecer contraseña:</h3>
                <p>Introduce tu nueva contraseña y confírmala para poder acceder al sistema de nuevo.</p>
                <?= $form->field($model, 'password')->widget(PasswordInput::classname(), [
                    'pluginOptions' => [
                        'showMeter' => true,
                        'toggleMask' => false,
                    ]
                ])->label(false)->input('password',  ['placeholder' => "Introduce tu contraseña."])?>
                <?= $form->field($model, 'passwordConfirm')->passwordInput()->label(false)->input('password',  ['placeholder' => "Confirma tu contraseña."]) ?>

                <div class="form-group">
                    <?= Html::submitButton('Guardar', ['class' => 'float-left btn btn-lg btn-rounded btn-dark']) ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>
