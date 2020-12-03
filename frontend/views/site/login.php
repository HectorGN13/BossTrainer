<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\LoginForm */

use frontend\assets\LoginAsset;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use yii\bootstrap4\modal;

$this->title = 'Login';
LoginAsset::register($this);
?>

<div class="site-login">
    <div class="container scale-up-center my-5">
        <div class="row white center-vertically col-md-7 ml-auto mr-auto rounded-top">
            <div class="col-md-10 ml-auto mr-auto pt-5">
                <?= Html::img('@web/images/logoColor.png', ['alt' => 'BossTrainer', 'class' => 'col-md-8 img-fluid mx-auto d-block']) ?>
            </div>
        </div>
        <div class="row white center-vertically col-md-7 ml-auto mr-auto py-5 rounded-bottom">
            <div class="col-md-8 ml-auto mr-auto">
                <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'password')->passwordInput() ?>

                <?= $form->field($model, 'rememberMe')->checkbox() ?>

                <div style="color:#6b6b6b;margin:1em 0">
                    ¿Has olvidado tu contraseña? <?= Html::a('Restaurar contraseña', '#', ['value' =>Url::to('request-password-reset'), 'id' => 'restorePassLink']) ?>

                    <br>
                    ¿No has recibido el correo de verificación? <?= Html::a('Reenviar.', '#', ['value' =>Url::to('resend-verification-email'), 'id' => 'restoreVerificationEmail']) ?>

                </div>

                <div class="form-group float-right">
                    <?= Html::submitButton('INICIAR SESIÓN', ['class' => 'float-right btn btn-lg btn-rounded btn-dark', 'name' => 'login-button']) ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>
<?php
modal::begin([
    'title' => '<h2>Restaurar contraseña.</h2>',
    'id' => 'modalPass',
    'size' => 'modal-lg'
]);

echo "<div id='modalContent'></div>";
modal::end();
?>
<?php
modal::begin([
    'title' => '<h2>Reenviar correo.</h2>',
    'id' => 'modalEmail',
    'size' => 'modal-lg'
]);

echo "<div id='modalContent'></div>";
modal::end();
?>
