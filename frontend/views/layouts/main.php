<?php

/* @var $this \yii\web\View */
/* @var $content string */


use yii\helpers\Html;
use yii\bootstrap4\Nav;
use yii\bootstrap4\NavBar;
use frontend\assets\AppAsset;
use common\widgets\Alert;


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
    <link rel="stylesheet" href="https://cdn.linearicons.com/free/1.0.0/icon-font.min.css">
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
        <?= $content ?>
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
