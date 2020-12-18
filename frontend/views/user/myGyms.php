<?php

use frontend\assets\GymsAsset;
use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $searchModel common\models\GymSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
GymsAsset::register($this);
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
                        <img src="https://via.placeholder.com/500x320/" alt="Image" class="card-img-top img-responsive widget-header">
                        <div class="text-center">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/5/51/Facebook_f_logo_%282019%29.svg" class="rounded-circle widget-img" alt="">
                        </div>
                        <div class="card text-center">
                            <div class="card-body py-5">
                                <h5 class="card-title mt-3"><?= $model->name ?></h5>
                                <p class="card-text"><?= $model->description ?></p>
                                <p class="card-text"><?php if(isset($model->address)) echo $model->address . ","; ?>
                                    <?=  $model->postal_code ?> </p>
                                <p class="card-text"><?php if(isset($model->localidad->nombre_localidad))
                                        echo $model->localidad->nombre_localidad . "."; ?> <?php if(isset($model->provincia->nombre_provincia))
                                        echo $model->provincia->nombre_provincia; ?></p>
                                <?= Html::a('Visitar', ['view', 'id' => $model->id], ['class'=>'btn btn-dark btn-rounded']) ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>