<?php

use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\Pjax;


/* @var $this yii\web\View */
/* @var $searchModel backend\models\BoardSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pizarras';

?>
<div class="board-index">
    <div class="board-list container">
        <div class="lines-effect">
            <h1 class="text-responsive" style="text-transform: uppercase"><?= Html::encode($this->title) ?></h1>
        </div>
            <p>
                <?= Html::a('Crear Pizarra', ['create'], ['class' => 'btn btn-pink']) ?>
            </p>
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'options' => ['class' => 'custom-table'],
                'tableOptions' => ['class' => 'table table-hover table-sm'],
                'layout' => '{items}{pager}',
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    [
                        'attribute'=>'title',
                        'format'=>'raw',
                        'value' => function($model, $key, $index, $widget)
                        {
                            return Html::a($model->title, ['board/view','id'=> $key]);
                        }
                    ],


                    [
                        'header' => 'Acciones',
                        'content' => function ($model, $key, $index, $widget) {
                            $del =  Html::a(Html::tag('span','<i class="fas fa-trash-alt"></i>', ['class' => 'btn btn-sm btn-danger']),
                                ['board/delete', 'id' => $model->id],
                                [
                                    'data' => [
                                        'confirm' => '¿Estas seguro de que quieres borrar este elemento?',
                                        'method' => 'post',
                                    ],
                                    'class' => 'px-1'
                                ]
                            );

                            $upd = Html::a(Html::tag('span','<i class="fas fa-pen"></i>', ['class' => 'btn btn-sm btn-success']),
                                ['board/update', 'id' => $key], ['class' => 'uploadBoard']);

                            $default = Html::a(Html::tag('span','Por defecto', ['class' => 'btn btn-sm btn-info']),
                                ['board/default'],
                                [
                                        'data' => [
                                            'method' => 'post',
                                            'params' => ['id' => $key],
                                        ],
                                    'class' => 'px-1'
                                ]
                            );
                            return  $upd . $del . $default ;
                        }
                    ],
                ],
            ]); ?>
    </div>
    <?php Pjax::begin(['id'=>'id-pjax']); ?>
    Content that needs to be updated
    <?php Pjax::end(); ?>
</div>
