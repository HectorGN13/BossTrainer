<?php

/* @var $this \yii\web\View */
/* @var $content string */


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
        /** SIDEBAR **/

        #sidebar {
            background:#5bc995;
            height:100vh;
            width:240px;
            position:fixed;
            top:0;
            left:0;
            z-index:5;
            outline:none;
            -webkit-transition: margin .25s ease-out;
            -moz-transition: margin .25s ease-out;
            -o-transition: margin .25s ease-out;
            transition: margin .25s ease-out;
        }
        #sidebar .avatar {
            background:rgba(0,0,0,0.1);
            padding:2em 0.5em;
            text-align:center;
        }
        #sidebar .avatar img {
            width: 170px;
            height:170px;
            border-radius: 50%;
            overflow: hidden;
            box-shadow: 0 0 0 4px rgba(255, 255, 255, 0.2);
        }

        #sidebar h3 {
            font-weight:normal;
            margin-bottom:0;
        }

        #sidebar ul {
            list-style: none;
            padding: 0.5em 0;
            margin: 0;
        }

        #sidebar ul li {
            padding: 0.5em 1em 0.5em 3em;
            font-size: 0.95em;
            font-weight: 500;
            background-repeat: no-repeat;
            background-position: left 15px center;
            background-size: auto 20px;
            transition: all 0.15s linear;
            cursor: pointer;
        }

        #sidebar ul li:hover {
            background-color: rgba(0, 0, 0, 0.1);
        }
        #sidebar ul li:focus {
            outline: none;
        }

        /**Accion de ocultar**/
        #wrapper.toggled #sidebar {
            margin-left: 0;
        }
        #wrapper.toggled #togglebutton {
            margin-left: -200px;
        }
        @media (min-width: 768px) {
            #wrapper.toggled #sidebar {
                margin-left: -15rem;
            }
        }

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

        /** tooglebutton **/
        #togglebutton {
            width: 30px;
            height: 50px;
            top: 70px;
            left: 235px;
            -webkit-transition: margin .25s ease-out;
            -moz-transition: margin .25s ease-out;
            -o-transition: margin .25s ease-out;
            transition: margin .25s ease-out;
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
            <nav id="sidebar">
                <!-- Toggle button -->
                <div id="togglebutton" class="button-special">
                    <i class="fas fa-chevron-right"></i>
                </div>
                <div class="img bg-wrap text-center py-4 pt-5">
                    <div class="avatar">
                        <img src="https://www.dzoom.org.es/wp-content/uploads/2020/02/portada-foto-perfil-redes-sociales-consejos-810x540.jpg" class="img-responsive" alt="foto perfil"/>
                        <h3>Patricia Henderson</h3>
                    </div>
                </div>
                <?= NavSidebar::widget([
                    'items' => [
                        [
                            'url' => ['site/index'],
                            'label' => 'Home',
                            'icon' => 'home'
                        ],
                        [
                            'url' => ['site/about'],
                            'label' => 'about',
                            'icon' => 'info-sign'
                        ],
                    ],
                ]) ?>
            </nav>
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
