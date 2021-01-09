<?php

/* @var $this yii\web\View */
/* @var $searchModel backend\models\TrainingSessionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $rates yii\data\ActiveDataProvider */
/* @var $namesRates yii\data\ActiveDataProvider */
/* @var $occupation yii\data\ActiveDataProvider */

use miloschuman\highcharts\Highcharts;
use miloschuman\highcharts\SeriesDataHelper;
//var_dump($namesRates);
//die();
$this->title = 'BossTrainer';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Congratulations!</h1>

        <p class="lead">You have successfully created your Yii-powered application.</p>

        <p><a class="btn btn-lg btn-success" href="http://www.yiiframework.com">Get started with Yii</a></p>
    </div>

    <div class="body-content container">

        <div class="row">
            <div class="col-lg-6">
                <div>
                    <?php

                    echo Highcharts::widget([
                        'options' => [
                            'chart' => ['type' => 'column'],
                            'credits' => ['enabled' => false],
                            'title' => ['text' => 'Ocupación de Sesiones '.date('d-m-Y')],
                            'xAxis' => [
                                'categories' => new SeriesDataHelper($dataProvider, ['start_time:date']),
                            ],
                            'yAxis' => [
                                'allowDecimals' => false,
                                'title' => ['text' => 'Usuarios']
                            ],
                            'series' => [
                                [
                                    'name' => 'Ocupación',
                                    'data' => $occupation,
                                ]
                            ],
                        ],

                        'scripts' => [
                            'highcharts-more',   // enables supplementary chart types (gauge, arearange, columnrange, etc.)
                            'modules/exporting',
                            'themes/grid'
                        ],


                    ]);
                    ?>
                </div>
            </div>
            <div class="col-lg-6">
                <div>
                    <?php

                    echo Highcharts::widget([
                        'options' => [
                            'chart' => [
                                'plotBackgroundColor' => null,
                                'plotBorderWidth' => null,
                                'plotShadow' => false,
                                'type' => 'pie'
                            ],
                            'credits' => ['enabled' => false],
                            'title' => ['text' => 'Ingresos totales en el mes de '.date('F')],
                            'plotOptions' => [
                                'pie' => [
                                    'allowPointSelect' => true,
                                    'cursor' => 'pointer',
                                    'dataLabels' => [
                                        'enabled' => false,
                                    ],
                                    'showInLegend' => true,
                                ],
                            ],
                            'accessibility' => [
                                'point' => [
                                    'valueSuffix' => '€'
                                ],
                            ],
                            'series' => [
                                [
                                    'name' => 'Ingresos',
                                    'colorByPoint' => true,
                                    'data' => $namesRates,
                                ]
                            ],

                        'scripts' => [
                            'highcharts-more',   // enables supplementary chart types (gauge, arearange, columnrange, etc.)
                            'modules/exporting',
                            'themes/grid'
                        ],


                    ]]);
                    ?>
                </div>
            </div>
        </div>

    </div>
</div>
