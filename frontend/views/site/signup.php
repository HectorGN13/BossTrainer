<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap4\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use frontend\assets\SignupAsset;
use kartik\password\PasswordInput;
use yii\bootstrap4\Alert;
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;

SignupAsset::register($this);
$this->title = 'Registrarse';
?>
<div class="site-signup">
    <div class="container scale-up-center my-5">
        <div class="row white center-vertically col-md-7 ml-auto mr-auto rounded-top">
            <div class="col-md-10 ml-auto mr-auto pt-5 ">
                <?= Html::img('@web/images/logoColor.png', ['alt' => 'BossTrainer', 'class' => 'col-md-8 img-fluid mx-auto d-block']) ?>
            </div>
        </div>
        <div class="row white center-vertically col-md-7 ml-auto mr-auto py-5 rounded-bottom">
            <div class="col-md-8 ml-auto mr-auto">
                <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

                <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

                <?= $form->field($model, 'email') ?>

                <?= $form->field($model, 'password')->widget(PasswordInput::classname(), [
                    'pluginOptions' => [
                        'showMeter' => true,
                        'toggleMask' => false,
                    ]
                ])?>

                <?= $form->field($model, 'passwordConfirm')->passwordInput() ?>

                <div class="form-group float-right">
                    <?= Html::submitButton('REGISTRARSE', ['class' => 'float-right btn btn-lg btn-rounded btn-dark', 'name' => 'signup-button']) ?>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
            <div class="alert-container pt-3">
                <?= Alert::widget([
                    'options' => [
                        'class' => 'alert-info',
                    ],
                    'body' => 'Aviso: El registro solo está disponible para atletas, si eres propietario de un gimnasio, por favor póngase en contacto con nosotros a través de nuestro ' . Html::a('formulario de contacto.', ['site/index', '#' => 'contact']),
                ]); ?>
            </div>
        </div>
    </div>

</div>
