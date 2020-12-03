<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap4\ActiveForm */
/* @var $model \frontend\models\ResetPasswordForm */

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

$this->title = 'Reenviar correo de verificación';
?>
<div class="site-resend-verification-email">
    <p>Por favor, introduzca su dirección de correo electrónico. Asegúrese de que sea una dirección de email válida, ya que se le enviará un enlace para verificar su cuenta.</p>

    <div class="row">
        <div class="col-12">
            <?php $form = ActiveForm::begin(['id' => 'resend-verification-email-form', 'enableAjaxValidation' => true]); ?>

            <?= $form->field($model, 'email')->textInput(['autofocus' => true])->input('email',  ['placeholder' => "Introduce tu correo."])->label(false) ?>

            <div class="d-flex justify-content-center form-group">
                <?= Html::submitButton('Enviar', ['class' => 'btn btn-lg btn-rounded btn-dark']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
