<?php

use miloschuman\highcharts\Highcharts;
use miloschuman\highcharts\SeriesDataHelper;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\VarDumper;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\WeightSeach */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Weights';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="weight-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Weight', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php

    VarDumper::dump($dataProvider);

    echo Highcharts::widget([
        'options' => [
            'title' => ['text' => 'Fruit Consumption'],
            'xAxis' => [
                'categories' => ['Apples', 'Bananas', 'Oranges']
            ],
            'yAxis' => [
                'title' => ['text' => 'Kg']
            ],
            'series' => [
                ['name' => 'Jane', 'data' => [1, 0, 4]],
                ['name' => 'John', 'data' => [5, 7, 3]]
            ]
        ]
    ]);
    ?>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'user_id',
            'value',
            'create_at',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
