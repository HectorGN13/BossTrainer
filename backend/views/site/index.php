<?php

/* @var $this yii\web\View */
/* @var $searchModel backend\models\TrainingSessionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $ocupation yii\data\ActiveDataProvider */

use miloschuman\highcharts\Highcharts;
use miloschuman\highcharts\SeriesDataHelper;
//var_dump($ocupation);
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
                                    'data' => $ocupation,
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
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/forum/">Yii Forum &raquo;</a></p>
            </div>
        </div>

    </div>
</div>
