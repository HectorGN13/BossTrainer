<?php

/* @var $this yii\web\View */


use frontend\assets\AppAsset;
use lanselot\parallax\ParallaxWidget;
use yii\helpers\Html;

AppAsset::register($this);
$this->title = 'BossTrainer';
?>

<?= ParallaxWidget::widget([
    'image' => '/images/bg-index.jpg',
    'element' => '.parallax1',
    'minHeight' => '400px',
]); ?>
<div class="container-fluid bg-index">
    <div id="logo" class="row">
        <div class="d-none d-lg-block d-xl-block col-md-6 col-lg-6 first-column">
            <?= Html::img('@web/images/iconWHITE.png', ['alt'=>'BossTrainer', 'class'=>'mt-5 mr-4 img-fluid float-right image-primary']);?>
        </div>
        <div class="d-none d-lg-block d-xl-block col-xs-12 col-md-6 col-lg-6 second-column">
            <?= Html::img('@web/images/mejorAPP.png', ['alt'=>'Mejor App', 'class'=>'my-4 img-fluid float-left image-secondary']);?>
        </div>
        <div class="d-block d-lg-none d-xl-none col-xs-12 col-md-12 col-lg-6 second-column mx-auto">
            <?= Html::img('@web/images/mejorAPP.png', ['alt'=>'Mejor App', 'class'=>'my-4 mx-auto d-block img-fluid image-secondary']);?>
        </div>
    </div>
</div>

<div class="site-index">
    <div class="container">
        <div class="jumbotron">
            <div class="lines-effect">
                <h1 class="lines-effect text-responsive">CARACTERÍSTICAS</h1>
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

            <p><a class="btn btn-lg btn-primary" href="http://www.yiiframework.com">MÁS INFORMACIÓN</a></p>
        </div>
    </div>

    <div class="container body-content">

        <div class="row">
            <div class="col-lg-4">
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/doc/">Yii Documentation &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/forum/">Yii Forum &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/extensions/">Yii Extensions &raquo;</a></p>
            </div>
        </div>
    </div>
    <?= ParallaxWidget::widget([
        'image' => '/images/slide4.jpg',
        'element' => '.parallax2',
        'minHeight' => '400px',
    ]); ?>
</div>
<script>
    $logo = document.getElementById("logo");
    $(document).ready(function(){
        $('.parallax1).append($logo);
    });
</script>