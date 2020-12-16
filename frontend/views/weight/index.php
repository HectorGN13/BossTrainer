<?php

use frontend\assets\WeightAsset;
use miloschuman\highcharts\Highcharts;
use miloschuman\highcharts\SeriesDataHelper;
use yii\bootstrap4\Modal;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\web\JsExpression;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\WeightSeach */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Mi progreso';
WeightAsset::register($this);
?>
<div class="weight-index">
    <div class="container">
        <h1><?= Html::encode($this->title) ?></h1>

        <p>
            <?= Html::a('Añadir registro', '#',
                ['value' =>Url::to(['weight/create']), 'class' => 'btn btn-info mt-3', 'id' => 'addProgress']); ?>
        </p>
    <div>
        <?php

        echo Highcharts::widget([
            'options' => [
                'credits' => ['enabled' => false],
                'title' => ['text' => 'Mi progreso'],
                'xAxis' => [
                    'categories' => new SeriesDataHelper($dataProvider, ['create_at:date']),
                ],
                'yAxis' => [
                    'title' => ['text' => 'Kg']
                ],
                'series' => [
                    [
                        'name' => 'Peso corporal',
                        'data' => new SeriesDataHelper($dataProvider, ['value'])
                    ]
                ],
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
                    'enableSorting' => true,
                ],
                [
                   'attribute' => 'Peso',
                   'value' => 'value',
                    'enableSorting' => true,
                ],
                [
                    'header' => 'Acciones',
                    'content' => function ($model, $key, $index, $widget) {
                        return Html::a(Html::tag('span','<i class="fas fa-trash-alt"></i>', ['class' => 'btn btn-sm btn-danger']),
                            ['weight/delete', 'id' => $model->id],
                            ['data-method' => 'POST',  'class' => 'px-1']);
                    }
                ],
            ],
        ]); ?>
    </div>
    </div>
</div>
<?php
Modal::begin([
    'title' => '<h2>Añadir Registro.</h2>',
    'id' => 'modalAddProgress',
    // 'size' => 'modal-lg',
]);

echo "<div id='modalContent'></div>";
Modal::end();
?>