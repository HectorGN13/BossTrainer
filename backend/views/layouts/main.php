<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
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
    <script src="https://use.fontawesome.com/releases/v5.15.1/js/all.js" data-auto-replace-svg="nest"></script>
    <link rel="stylesheet" href="https://cdn.linearicons.com/free/1.0.0/icon-font.min.css">
    <style>
        #content {
            width: 100%;
            margin-left:15%;
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
            'class' => 'navbar sticky-top navbar-expand-lg navbar-inverse border-0',
        ],
    ]);
    $menuItems = [
        ['label' => Html::tag('i','', ['class' => 'fas fa-inbox']), 'url' => ['#'], "linkOptions" => ["class" => '']],
    ];
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right user-navbar'],
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
                            'url' => ['site/logout'],
                            'options' => 'data-method=POST',
                            'label' => 'Desconectarse',
                            'icon' => 'fas fa-power-off'
                        ]
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

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; <?= Html::encode(Yii::$app->name) ?> <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
