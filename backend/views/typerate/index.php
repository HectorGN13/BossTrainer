<?php

use backend\assets\BoardAsset;
use kartik\grid\GridView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\TypeRateSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tarifas';
BoardAsset::register($this);
?>
<div class="type-rate-index container">
    <div class="type-rate-list container mb-5">
    <div class="lines-effect">
        <h1 class="text-responsive" style="text-transform: uppercase"><?= Html::encode($this->title) ?></h1>
    </div>

    <p>
        <?= Html::a('Crear Tarifa', ['create'], ['class' => 'btn btn-warning']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'condensed' => true,
        'bordered' => false,
        'striped' => false,
        'pjax' => true,
        'pjaxSettings' => ['loadingCssClass' => false],
        'options' => ['class' => 'custom-table'],
        'tableOptions' => ['class' => 'table table-hover table-sm'],
        'layout' => '{items}{pager}',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'title',
            'description',
            'price',

            [
                'header' => 'Acciones',
                'content' => function ($model, $key, $index, $widget) {
                    $del =  Html::a(Html::tag('span','<i class="fas fa-trash-alt"></i>', ['class' => 'btn btn-sm btn-danger']),
                        ['typerate/delete', 'id' => $model->id],
                        [
                            'data' => [
                                'confirm' => '¿Estas seguro de que quieres borrar este elemento?',
                                'method' => 'post',
                            ],
                            'class' => 'px-1'
                        ]
                    );

                    $upd = Html::a(Html::tag('span','<i class="fas fa-pen"></i>', ['class' => 'btn btn-sm btn-success']),
                        ['typerate/update', 'id' => $key], ['class' => 'uploadBoard']);

                    $view = Html::a(Html::tag('span','<i class="fas fa-eye"></i>', ['class' => 'btn btn-sm btn-info']),
                        ['typerate/view'],
                        [
                            'data' => [
                                'method' => 'post',
                                'params' => ['id' => $key],
                            ],
                            'class' => 'px-1'
                        ]
                    );
                    return  $upd . $del . $view ;
                }
            ],
        ],
    ]); ?>
    </div>
</div>
