<?php


use frontend\assets\MaterialAsset;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Gym */

$this->title = $model->name;
MaterialAsset::register($this);
?>
<body class="profile-page sidebar-collapse">
<div class="page-header header-filter" data-parallax="true" style="background-image: url(https://images7.alphacoders.com/105/thumb-1920-1052530.jpg); transform: translate3d(0px, 0px, 0px);"></div>
<div class="main main-raised">
    <div class="profile-content">
        <div class="container">
            <div class="row">
                <div class="col-md-6 ml-auto mr-auto">
                    <div class="profile">
                        <div class="avatar">
                            <img src="https://scontent-mad1-1.xx.fbcdn.net/v/t1.0-9/p960x960/79534733_1177160199156807_7504685025900625920_o.jpg?_nc_cat=102&ccb=2&_nc_sid=85a577&_nc_ohc=rMJwuG_4Cz4AX_1GL3X&_nc_oc=AQkvv29dUmYgGHB3CiqzzIkrvb1NM6rFVqVAISsFpW0t1GxJ6-Akz1RYNn0rLl8H1eM&_nc_ht=scontent-mad1-1.xx&tp=6&oh=88610b4e7f0167d8cd295421c0248f16&oe=5FF04473" alt="Circle Image" class="img-raised rounded-circle img-fluid" style="width: 400px;">
                        </div>
                        <div class="name">
                            <h1 class="title"><?= $model->name ?></h1>
                            <h6>Designer</h6>
                            <a href="#pablo" class="btn btn-just-icon btn-link btn-dribbble"><i class="fa fa-dribbble"></i></a>
                            <a href="#pablo" class="btn btn-just-icon btn-link btn-twitter"><i class="fa fa-twitter"></i></a>
                            <a href="#pablo" class="btn btn-just-icon btn-link btn-pinterest"><i class="fa fa-pinterest"></i></a>
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
                                <a class="nav-link active" href="#studio" role="tab" data-toggle="tab">
                                    <i class="material-icons">camera</i> Studio
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#works" role="tab" data-toggle="tab">
                                    <i class="material-icons">palette</i> Work
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#favorite" role="tab" data-toggle="tab">
                                    <i class="material-icons">favorite</i> Favorite
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="tab-content tab-space">
                <div class="tab-pane active text-center gallery" id="studio">
                    <div class="row">
                        <div class="col-md-3 ml-auto">
                            <img src="../assets/img/examples/studio-1.jpg" class="rounded">
                            <img src="../assets/img/examples/studio-2.jpg" class="rounded">
                        </div>
                        <div class="col-md-3 mr-auto">
                            <img src="../assets/img/examples/studio-5.jpg" class="rounded">
                            <img src="../assets/img/examples/studio-4.jpg" class="rounded">
                        </div>
                    </div>
                </div>
                <div class="tab-pane text-center gallery" id="works">
                    <div class="row">
                        <div class="col-md-3 ml-auto">
                            <img src="../assets/img/examples/olu-eletu.jpg" class="rounded">
                            <img src="../assets/img/examples/clem-onojeghuo.jpg" class="rounded">
                            <img src="../assets/img/examples/cynthia-del-rio.jpg" class="rounded">
                        </div>
                        <div class="col-md-3 mr-auto">
                            <img src="../assets/img/examples/mariya-georgieva.jpg" class="rounded">
                            <img src="../assets/img/examples/clem-onojegaw.jpg" class="rounded">
                        </div>
                    </div>
                </div>
                <div class="tab-pane text-center gallery" id="favorite">
                    <div class="row">
                        <div class="col-md-3 ml-auto">
                            <img src="../assets/img/examples/mariya-georgieva.jpg" class="rounded">
                            <img src="../assets/img/examples/studio-3.jpg" class="rounded">
                        </div>
                        <div class="col-md-3 mr-auto">
                            <img src="../assets/img/examples/clem-onojeghuo.jpg" class="rounded">
                            <img src="../assets/img/examples/olu-eletu.jpg" class="rounded">
                            <img src="../assets/img/examples/studio-1.jpg" class="rounded">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
