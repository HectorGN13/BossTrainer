<?php

use frontend\assets\GymsAsset;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\GymSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
GymsAsset::register($this);
$this->title = 'Gimnasios';
?>
<div class="gym-index">


    <?php  echo $this->render('_search', ['model' => $searchModel]); ?>
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
                        <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
                        <a href="#" class="btn btn-primary">Go somewhere</a>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'name',
            'address',
            'email:email',
            'auth_key',


            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
