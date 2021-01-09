<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;
use backend\components\navbar\NavSidebar;
use frontend\components\modalalert\ModalAlert;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.2.0/jspdf.umd.min.js"></script>
    <script src="https://use.fontawesome.com/releases/v5.15.1/js/all.js" data-auto-replace-svg="nest"></script>
    <link rel="stylesheet" href="https://cdn.linearicons.com/free/1.0.0/icon-font.min.css">
    <style>
        #content {
            width: 100%;
            padding: 0;
            min-height: 100vh;
            -webkit-transition: all 0.3s;
            -o-transition: all 0.3s;
            transition: all 0.3s;
        }

    </style>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => Html::img('@web/images/logoBlanco.png', ['alt'=>Yii::$app->name, 'style' => 'width:210px; margin-top:-12px']),
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar navbar-dark sticky-top navbar-expand-lg',
        ],
    ]);
    $menuItems = [];
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right user-navbar navbar navbar-dark bg-dark'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>
    <div class="container-fluid">
        <?= ModalAlert::widget() ?>
    </div>
    <div class="container-fluid">
        <div id="wrapper" class="wrapper d-flex align-items-stretch">
            <?php
            if (!Yii::$app->user->isGuest) {
                echo NavSidebar::widget([
                    'items' => [
                        [
                            'url' => ['site/index'],
                            'options' => '',
                            'label' => 'Estadísticas',
                            'icon' => 'fas fa-tachometer-alt'
                        ],
                        [
                            'url' => ['trainingsession/index'],
                            'options' => '',
                            'label' => 'Entrenamientos',
                            'icon' => 'fas fa-clipboard-list'
                        ],
                        [
                            'url' => ['board/index'],
                            'options' => '',
                            'label' => 'Pizarras',
                            'icon' => 'fas fa-chalkboard-teacher'
                        ],
                        [
                            'url' => ['typerate/index'],
                            'options' => '',
                            'label' => 'Tarifas',
                            'icon' => 'fas fa-tags'
                        ],
                        [
                            'url' => ['site/invoice'],
                            'options' => '',
                            'label' => 'FacturasGEN',
                            'icon' => 'fas fa-receipt'
                        ],
                        [
                            'url' => ['site/broadcast'],
                            'options' => '',
                            'label' => 'Broadcast',
                            'icon' => 'fas fa-bullhorn'
                        ],
                        [
                            'url' => ['site/followers'],
                            'options' => '',
                            'label' => 'Usuarios',
                            'icon' => 'fas fa-users'
                        ],
                        [
                            'url' => ['site/settings'],
                            'options' => '',
                            'label' => 'Settings',
                            'icon' => 'fas fa-tools'
                        ],
                        [
                            'url' => ['site/logout'],
                            'options' => 'data-method=POST',
                            'label' => 'Desconectarse',
                            'icon' => 'fas fa-power-off'
                        ],
                    ],
                ]);
            }
            ?>
            <div id="content" class="container-fluid">
                <?= $content ?>
            </div>
            <!-- botton arriba-->
            <div id="button-up" class="button-special">
                <i class="fas fa-chevron-up"></i>
            </div>
        </div>
    </div>
</div>

<footer class="footer text-white">
    <div class="container">
        <div class="row">
            <div class="mr-auto">&copy; <?= Html::encode(Yii::$app->name) ?> <?= date('Y') ?></div>
            <div class=""> <?= Yii::powered() ?> </div>
        </div>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
