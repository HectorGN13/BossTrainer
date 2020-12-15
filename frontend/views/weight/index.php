<?php

use miloschuman\highcharts\Highcharts;
use miloschuman\highcharts\SeriesDataHelper;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\VarDumper;
use yii\web\JsExpression;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\WeightSeach */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Mi progreso';

?>
<div class="weight-index">
    <div class="container">
        <h1><?= Html::encode($this->title) ?></h1>

        <p>
            <?= Html::a('Añadir registro', ['create'], ['class' => 'btn btn-info mt-3']) ?>
        </p>
    <div>
        <?php

        echo Highcharts::widget([
            'options' => [
                'credits' => ['enabled' => false],
                'title' => ['text' => 'Mi progreso'],
                'xAxis' => [
                    'categories' => new SeriesDataHelper($dataProvider, ['create_at:date'])

                ],
                'yAxis' => [
                    'title' => ['text' => 'Kg']
                ],
                'series' => [
                    [
                        'name' => 'Peso corporal',
                        'data' => new SeriesDataHelper($dataProvider, ['value'])
                    ]
                ]
            ],
            'scripts' => [
                'highcharts-more',   // enables supplementary chart types (gauge, arearange, columnrange, etc.)
                'modules/exporting',
                'themes/dark-unica'
            ],


        ]);
        ?>
    </div>
    <div class="my-5">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'options' => ['class' => 'custom-table'],
            'tableOptions' => ['class' => 'table table-hover table-sm'],
            'layout' => '{items}{pager}',
            'columns' => [
                [
                    'attribute' => 'Fecha',
                    'format' => ['date', 'php:d M Y'],
                    'value' => 'create_at',
                ],
                [
                   'attribute' => 'Peso',
                   'value' => 'value',
                ],

            ],
        ]); ?>
    </div>
    </div>
</div>
