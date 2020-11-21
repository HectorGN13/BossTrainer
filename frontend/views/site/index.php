<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap4\ActiveForm */
/* @var $model \frontend\models\ContactForm */
/* @var $content string */


use frontend\assets\AppAsset;
use kekaadrenalin\recaptcha3\ReCaptchaWidget;
use lanselot\parallax\ParallaxWidget;
use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use pa3py6aka\yii2\ModalAlert;

AppAsset::register($this);
$this->title = 'BossTrainer';
?>
<?php
    $parallaxContain2 = sprintf("<div class=\"container-fluid bg-index\">
    <div id=\"logo\" class=\"row\">
        <div class=\"d-none d-lg-block d-xl-block col-md-6 col-lg-6 first-column\">%s</div>
        <div class=\"d-none d-lg-block d-xl-block col-xs-12 col-md-6 col-lg-6 second-column\">%s</div>
        <div class=\"d-block d-lg-none d-xl-none col-xs-12 col-md-12 col-lg-6 second-column mx-auto\">%s</div>
    </div>
</div>",
        Html::img('@web/images/iconWHITE.png', ['alt' => 'BossTrainer', 'class' => 'mt-5 mr-4 img-fluid float-right image-primary']),
        Html::img('@web/images/mejorAPP.png', ['alt' => 'Mejor App', 'class' => 'my-4 img-fluid float-left image-secondary']),
        Html::img('@web/images/mejorAPP.png', ['alt' => 'Mejor App', 'class' => 'my-4 mx-auto d-block img-fluid image-secondary']))
?>

<?= ParallaxWidget::widget([
    'image' => '/images/bg-index.jpg',
    'element' => '.parallax1',
    'minHeight' => '400px',
    'content' => $parallaxContain2,
]); ?>
<div class="site-index">
    <div class="container">
        <div class="jumbotron">
            <div class="lines-effect">
                <h1 class="text-responsive">CARACTERÍSTICAS</h1>
            </div>
            <div class="row">
                <div class="icon-block pt-lg-5 col-lg-4">
                    <i class="lnr lnr-heart-pulse"></i>
                    <h2>Clases y WODs</h2>
                    <p>Programá las clases y sus rutinas diarias.
                        Crea secciones de rutinas exclusivas para diferentes grupos de usuarios.</p>
                </div>

                <div class="icon-block pt-lg-5 col-lg-4">
                    <i class="lnr lnr-license"></i>
                    <h2>RM y Benchmarks</h2>
                    <p>Todos los RM, benchmarks y habilidades.
                        Info de cada ejercicio, registro de resultados y ranking general.</p>
                </div>

                <div class="icon-block pt-lg-5 col-lg-4">
                    <i class="lnr lnr-calendar-full"></i>
                    <h2>Agenda de clases</h2>

                    <p>Calendario de clases por disciplinas, con reserva de turnos y control de capacidad máxima.</p>
                </div>
            </div>
            <div class="row">
                <div class="icon-block col-lg-4">
                    <i class="lnr lnr-alarm"></i>
                    <h2>Notificaciones</h2>

                    <p>Sección de noticias para informar las novedades de tu gimnasio.
                        Comunicate en tiempo real con tus atletas.</p>
                </div>

                <div class="icon-block col-lg-4">
                    <i class="lnr lnr-lock"></i>
                    <h2>Control de acceso</h2>

                    <p>Elige quienes acceden a tus clases.
                        Sistema de activación y suspensión automática por falta de pago.</p>
                </div>

                <div class="icon-block col-lg-4">
                    <i class="lnr lnr-diamond"></i>
                    <h2>Y mucho más!</h2>

                    <p>Sección de beneficios, chat, registro de pesos, mensajes individuales y muchas funciones más.</p>
                </div>
            </div>

            <p><a class="btn btn-lg btn-rounded btn-dark" href="http://www.yiiframework.com">MÁS INFORMACIÓN</a></p>
        </div>
    </div>

    <div class="container body-content">

    </div>
    <?php
     $parallaxContain2 = '<div class="col-12 mx-auto d-fex align-middle" >'
         . Html::img('@web/images/logoBlanco.png',
             ['alt'=>'BossTrainer', 'class'=>'img-fluid d-block mx-auto align-middle']) . '</div>';

    ?>
    <?= ParallaxWidget::widget([
        'image' => '/images/slide4.jpg',
        'element' => '.parallax2',
        'minHeight' => '400px',
        'content' => $parallaxContain2,
    ]); ?>

    <div class="container">
        <div class="row">
            <div class="col-12">
                <h3 class="text-responsive">CONTACTO</h3>
            </div>
            <div class="container-fluid">
                <?= ModalAlert::widget() ?>
            </div>
            <div class="col-12 col-lg-8 ml-auto mr-auto">
                <?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>

                <div class="row">
                    <div class="col-md-5">
                        <?= $form->field($model, 'name') ?>
                    </div>
                    <div class="col-md-7">
                        <?= $form->field($model, 'surname') ?>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-8">
                        <?= $form->field($model, 'email') ?>
                    </div>
                    <div class="col-md-4">
                        <?= $form->field($model, 'phone') ?>
                    </div>
                </div>

                <div>
                    <?= $form->field($model, 'subject') ?>
                </div>
                <div>
                    <?= $form->field($model, 'body')->textarea(['rows' => 5]) ?>
                </div>

                <div class="row">
                    <div class="col-6">
                        <?= $form->field($model, 'agree',
                            ['options' => ['tag' => 'span',]])->checkbox(['checked' => false]); ?>
                        <?= $form->field($model, 'reCaptcha')->widget(ReCaptchaWidget::class) ?>
                    </div>
                    <div class="form-group col-6">
                        <?= Html::submitButton('Enviar', ['class' => 'float-right btn btn-lg btn-rounded btn-dark', 'name' => 'contact-button']) ?>
                    </div>
                </div>


                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-lg-8 ml-auto mr-auto text-center">
                <h3 class="text-responsive">DISPONIBLE PARA ANDROID & IOS</h3>
                <?= Html::img('@web/images/google-play.png', ['alt' => 'google play', 'class' => 'img-fluid mr-md-3 mb-3', 'style' => 'width: 200px']) ?>
                <?= Html::img('@web/images/app-store.png', ['alt' => 'app store', 'class' => 'img-fluid mb-3', 'style' => 'width: 200px']) ?>
            </div>
        </div>
    </div>

</div>
