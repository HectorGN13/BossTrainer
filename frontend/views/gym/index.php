<?php

use frontend\assets\GymsIndexAsset;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\GymSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
GymsIndexAsset::register($this);
$this->title = 'Gimnasios';

?>
<div class="gym-index">
    <div class="container" >
        <div class="d-flex justify-content-end" style="margin: 60px;">
            <?php  echo $this->render('_search', ['model' => $searchModel]); ?>
        </div>
    </div>
<div class="container">
    <div class="row row-cols-1 row-cols-md-3">
        <?php foreach ($dataProvider->models as $model):?>
        <div class="col mb-4">
            <div class="card h-100">
                <img src="<?= $model->banner_img?>" alt="Image" class="card-img-top img-responsive widget-header"
                     style="height: 200px;overflow: hidden;background-size: cover;background-position: center center;">
                <div class="card text-center">
                    <div class="card-body py-5">
                        <div class="text-center">
                            <img src="<?= $model->profile_img?>" class="rounded-circle" alt="logo" style="width: 120px;" >
                        </div>
                        <h5 class="card-title mt-3"><?= Html::encode($model->name) ?></h5>
                        <p class="card-text"><?= Html::encode($model->description) ?></p>
                        <p class="card-text"><?php if(isset($model->address)) echo Html::encode($model->address) . ","; ?>
                            <?=  Html::encode($model->postal_code) ?> </p>
                        <p class="card-text"><?php if(isset($model->localidad->nombre_localidad))
                                echo Html::encode($model->localidad->nombre_localidad) . "."; ?> <?php if(isset($model->provincia->nombre_provincia))
                                echo Html::encode($model->provincia->nombre_provincia); ?></p>
                        <?= Html::a('Visitar', ['view', 'id' => $model->id], ['class'=>'btn btn-dark btn-rounded']) ?>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>
</div>
