<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use backend\components\navbar\NavSidebar;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;
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
            /*width: 100%;*/
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
        'brandLabel' => Yii::$app->name,
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar sticky-top navbar-expand-lg navbar-inverse border-0',
        ],
    ]);
    
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Entrar', 'url' => ['/site/login'], "linkOptions" => ["class" => "links-color"]];
    } else {
        $menuItems[] = [ 'label' => Html::encode(Yii::$app->user->identity->username), 'items' => [
             Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton(
                'Salir',
                ['class' => 'btn btn-link logout btn-font-weight-900', 'style' => 'text-decoration: none; text-align: center;', 'id' => 'user-navbar']
            )
            . Html::endForm()]];
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right user-navbar'],
        'items' => $menuItems,
    ]);
    NavBar::end();
    ?>
    <div class="container-fluid">
        <?= ModalAlert::widget() ?>
    </div>
    <div class="container">
        <div id="wrapper" class="wrapper d-flex align-items-stretch">
            <?php
            if (!Yii::$app->user->isGuest) {
                echo NavSidebar::widget([
                    //'imgProfile' =>  'https://tdj.gg/uploads/attachs/20560_w9RC4W-QqXw-200x200.jpg',
                    //'nameProfile' => $value = (Yii::$app->user->isGuest) ? "invitado" : Html::encode(Yii::$app->user->identity->username),
                    'items' => [
                        [
                            'url' => ['trainingsession/index'],
                            'label' => 'Training Session',
                            'icon' => 'fas fa-trophy'
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
