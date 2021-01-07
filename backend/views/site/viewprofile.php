<?php

use frontend\assets\GymsAsset;
use yii\helpers\Html;
use kartik\date\DatePicker;
use yii\web\JsExpression;
use yii\helpers\Url;
use common\models\UserTrainingSession;
use common\models\Board;
/* @var $this yii\web\View */
/* @var $model common\models\Gym */
/* @var $trainingSessionDataProvider common\models\TrainingSession */
/* @var $trainingSessionSearchModel backend\models\TrainingSessionSearch */

$this->title = $model->name;
GymsAsset::register($this);

$bannerImg = 'https://images7.alphacoders.com/105/thumb-1920-1052530.jpg';
if(isset($model->banner_img) && !empty($model->banner_img))
  $bannerImg = $model->banner_img;
$profileImg = 'https://scontent-mad1-1.xx.fbcdn.net/v/t1.0-9/p960x960/79534733_1177160199156807_7504685025900625920_o.jpg?_nc_cat=102&ccb=2&_nc_sid=85a577&_nc_ohc=rMJwuG_4Cz4AX_1GL3X&_nc_oc=AQkvv29dUmYgGHB3CiqzzIkrvb1NM6rFVqVAISsFpW0t1GxJ6-Akz1RYNn0rLl8H1eM&_nc_ht=scontent-mad1-1.xx&tp=6&oh=88610b4e7f0167d8cd295421c0248f16&oe=5FF04473';
if(isset($model->profile_img) && !empty($model->profile_img))
  $profileImg = $model->profile_img;
?>
<body class="profile-page sidebar-collapse">
<div class="page-header header-filter" data-parallax="true" style="background-image: url(<?= $bannerImg?>); transform: translate3d(0px, 0px, 0px);"></div>
<div class="main main-raised">
    <div class="profile-content">
        <div class="container">
            <div class="row">
                <div class="col-md-6 ml-auto mr-auto">
                    <div class="profile">
                        <div class="avatar">
                            <img src="<?= $profileImg?>" alt="Circle Image" class="img-raised rounded-circle img-fluid" style="width: 400px; background-color: white;">
                        </div>

                        <div class="name">
                            <div class="lines-effect">
                                <h1 class="text-responsive" style="text-transform: uppercase"><?= $model->name ?></h1>
                            </div>
                            <h6><?= $model->address?> &nbsp;<?= $model->postal_code?>&nbsp;<?= $model->getLocalidadName($model->localidad_id)?> (<?= $model->getProvinciaName($model->provincia_id)?>)</h6>
                            <a href="#" class="btn btn-just-icon btn-link "><i class="fab fa-facebook"></i></a>
                            <a href="#" class="btn btn-just-icon btn-link "><i class="fab fa-twitter"></i></a>
                            <a href="#" class="btn btn-just-icon btn-link "><i class="fab fa-instagram"></i></a>
                            <a href="#" class="btn btn-just-icon btn-link "><i class="fab fa-whatsapp"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="description text-center mb-5 pb-5">
                <p><?= $model->description ?></p>
            </div>
        </div>
    </div>
</div>