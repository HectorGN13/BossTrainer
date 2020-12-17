<?php


use frontend\assets\MaterialAsset;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Gym */
$this->title = $model->name;
MaterialAsset::register($this);
\yii\helpers\VarDumper::dump($model->userFollowExist());
?>
<body class="profile-page sidebar-collapse">
<div class="page-header header-filter" data-parallax="true" style="background-image: url(https://images7.alphacoders.com/105/thumb-1920-1052530.jpg); transform: translate3d(0px, 0px, 0px);"></div>
<div class="main main-raised">
    <div class="profile-content">
        <div class="container">
            <div class="row">
                <div class="col-md-6 ml-auto mr-auto">
                    <?= Html::a((!$model->userFollowExist()) ? 'Unirse al Gim': 'Dejar el Gim', ['gym/follow','id' => $model->id], ['class' => 'btn btn-dark btn-md btn-follow']) ?>
                    <div class="profile">
                        <div class="avatar">
                            <img src="https://scontent-mad1-1.xx.fbcdn.net/v/t1.0-9/p960x960/79534733_1177160199156807_7504685025900625920_o.jpg?_nc_cat=102&ccb=2&_nc_sid=85a577&_nc_ohc=rMJwuG_4Cz4AX_1GL3X&_nc_oc=AQkvv29dUmYgGHB3CiqzzIkrvb1NM6rFVqVAISsFpW0t1GxJ6-Akz1RYNn0rLl8H1eM&_nc_ht=scontent-mad1-1.xx&tp=6&oh=88610b4e7f0167d8cd295421c0248f16&oe=5FF04473" alt="Circle Image" class="img-raised rounded-circle img-fluid" style="width: 400px;">
                        </div>

                        <div class="name">
                            <div class="lines-effect">
                                <h1 class="text-responsive" style="text-transform: uppercase"><?= $model->name ?></h1>
                            </div>
                            <h6>Designer</h6>
                            <a href="#" class="btn btn-just-icon btn-link "><i class="fab fa-facebook"></i></a>
                            <a href="#" class="btn btn-just-icon btn-link "><i class="fab fa-twitter"></i></a>
                            <a href="#" class="btn btn-just-icon btn-link "><i class="fab fa-instagram"></i></a>
                            <a href="#" class="btn btn-just-icon btn-link "><i class="fab fa-whatsapp"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="description text-center">
                <p><?= $model->description ?></p>
            </div>
            <div class="row">
                <div class="col-md-6 ml-auto mr-auto">
                    <div class="profile-tabs">
                        <ul class="nav nav-pills nav-pills-icons justify-content-center" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" href="#schedule" role="tab" data-toggle="tab">
                                    <i class="fas fa-clock"></i> HORARIOS
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#board" role="tab" data-toggle="tab">
                                    <i class="fas fa-chalkboard"></i> PIZARRA
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#ranking" role="tab" data-toggle="tab">
                                    <i class="fas fa-medal"></i> RANKING
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="tab-content tab-space">
                <div class="tab-pane active text-center gallery" id="schedule">
                    <div class="row">

                    </div>
                </div>
                <div class="tab-pane text-center gallery" id="board">
                    <div class="row">

                    </div>
                </div>
                <div class="tab-pane text-center gallery" id="ranking">
                    <div class="row">

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
