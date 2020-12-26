<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\NotificationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Mis Notificaciones';
?>
<div class="notification-index pt-5">
    <div class="notification-list container">
        <div class="lines-effect">
            <h1 class="text-responsive" style="text-transform: uppercase"><?= Html::encode($this->title) ?></h1>
        </div>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'Título',
                'value' => 'title',
                'enableSorting' => false,
            ],
            [
                'attribute' => 'Contenido',
                'value' => 'body',
                'enableSorting' => false,
            ],
            [
                'attribute' => 'Fecha',
                'format' => ['date', 'php:d M Y H:i:s'],
                'value' => 'created_at',
                'enableSorting' => true,
                'filter'=>true,
            ],
            [
                'header' => 'Acciones',
                'content' => function ($model, $key, $index, $widget) {
                    $open = Html::a(Html::tag('span', "<i class='fas fa-envelope''></i>", ['class' => 'btn btn-sm btn-info']),
                    ['notification/read'],
                        [
                            'data' => [
                                'method' => 'post',
                                'params' => ['notification_id' => $key],
                            ],
                            'class' => 'px-1'
                        ]
                    );

                    $close = Html::a(Html::tag('span', "<i class='fas fa-envelope-open-text'></i>", ['class' => 'btn btn-sm btn-info']),
                        ['notification/read'],
                        [
                            'data' => [
                                'confirm' => '¿Marcar como no leído?',
                                'method' => 'post',
                                'params' => ['id' => $key],
                            ],
                            'class' => 'px-1'
                        ]
                    );

                    $del =  Html::a(Html::tag('span','<i class="fas fa-trash-alt"></i>', ['class' => 'btn btn-sm btn-danger']),
                        ['notification/delete'],
                        [
                            'data' => [
                                'confirm' => '¿Estas seguro de que quieres borrar este elemento?',
                                'method' => 'post',
                                'params' => ['id' => $key],
                            ],
                            'class' => 'px-1'
                        ]
                    );

                    $info =  Html::a(Html::tag('span','<i class="fas fa-eye"></i>', ['class' => 'btn btn-sm btn-success']),
                        ['notification/view'],
                        [
                            'data' => [
                                'method' => 'post',
                                'params' => ['id' => $key],
                            ],
                            'class' => 'px-1'
                        ]
                    );

                    return  ($model->read == 10 ) ? $info . $open . $del : $info . $close . $del ;
                },
            ],
        ],
    ]); ?>
    </div>
</div>
