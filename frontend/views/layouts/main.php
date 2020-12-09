<?php

/* @var $this \yii\web\View */
/* @var $content string */
/* @var $model common\models\User */

use frontend\components\modalalert\ModalAlert;
use frontend\components\navbar\NavSidebar;
use yii\helpers\Html;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;
use frontend\assets\AppAsset;

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
        .button-special {
            background: black;
            display: flex;
            justify-content: center;
            align-items: center;
            color: white;
            border-radius: 12%;
            font-size: 20px;
            position: fixed;
            cursor: pointer;
            border: 4px solid transparent;
            transition: all 300ms ease;
        }

        /** button up **/

        #button-up {
            width: 50px;
            height: 30px;

            bottom: 70px;
            right: 40px;
            transform: scale(0);
        }
        #button-up:hover{
            transform: scale(1.1);
            border-color: rgba(0,0,0,0.1);
        }
        #button-up:hover{
            transform: scale(1.1);
            border-color: rgba(0,0,0,0.1);
        }

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
            'class' => 'navbar sticky-top navbar-expand-lg',
        ],

    ]);
    $menuItems = [
        ['label' => 'Home', 'url' => ['/site/index'], "linkOptions" => ["class" => "links-color"]],
        ['label' => 'About', 'url' => ['/site/about'], "linkOptions" => ["class" => "links-color"]],
        ['label' => 'Contact', 'url' => ['/site/contact'], "linkOptions" => ["class" => "links-color"]],
    ];
    if (Yii::$app->user->isGuest) {
        $menuItems[] = ['label' => 'Registrarse', 'url' => ['/site/signup'], "linkOptions" => ["class" => "links-color"]];
        $menuItems[] = ['label' => 'Entrar', 'url' => ['/site/login'], "linkOptions" => ["class" => "links-color"]];
    } else {
        $menuItems[] = [ 'label' => Html::encode(Yii::$app->user->identity->username), 'items' => [
             Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton(
                'Salir',
                ['class' => 'btn btn-link logout btn-font-weight-900', 'style' => 'text-decoration: none; text-align: center;']
            )
            . Html::endForm()]];
    }
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav'],
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
                    'imgProfile' =>  'https://tdj.gg/uploads/attachs/20560_w9RC4W-QqXw-200x200.jpg',
                    'nameProfile' => $value = (Yii::$app->user->isGuest) ? "invitado" : Html::encode(Yii::$app->user->identity->username),
                    'items' => [
                        [
                            'url' => ['site/benchmarks'],
                            'label' => 'Mis Benchmarks',
                            'icon' => 'fas fa-trophy'
                        ],
                        [
                            'url' => ['site/abilities'],
                            'label' => 'Mis Habilidades',
                            'icon' => 'fas fa-running'
                        ],
                        [
                            'url' => ['site/rms'],
                            'label' => 'Mis RMs',
                            'icon' => 'fas fa-medal'
                        ],
                        [
                            'url' => ['site/marks'],
                            'label' => 'Otras Marcas',
                            'icon' => 'fas fa-star'
                        ],
                        [
                            'url' => ['site/schedule'],
                            'label' => 'Mi Agenda',
                            'icon' => 'fas fa-calendar-check'
                        ],
                        [
                            'url' => ['site/my-gyms'],
                            'label' => 'Mis Gyms',
                            'icon' => 'fas fa-dumbbell'
                        ],
                        [
                            'url' => ['user/update', 'id' => Yii::$app->user->identity->id],
                            'label' => 'Mi Perfil',
                            'icon' => 'fas fa-user-circle'
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