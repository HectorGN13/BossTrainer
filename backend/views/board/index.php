<?php

use backend\assets\BoardAsset;
use kartik\grid\GridView;
use yii\helpers\Html;
use yii\widgets\Pjax;


/* @var $this yii\web\View */
/* @var $searchModel common\models\BoardSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pizarras';
BoardAsset::register($this);
?>

<div class="board-index">
    <div class="board-list container mb-5">
        <div class="lines-effect">
            <h1 class="text-responsive" style="text-transform: uppercase"><?= Html::encode($this->title) ?></h1>
        </div>
            <p>
                <?= Html::a('Crear Pizarra', ['create'], ['class' => 'btn btn-warning']) ?>
            </p>
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

                    [
                        'attribute'=>'title',
                        'format'=>'raw',
                        'value' => function($model, $key, $index, $widget)
                        {
                            return Html::a($model->title,'#',
                                [
                                    'onclick' => "loadBoard($key)",
                                ]);
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
    <div id="board-view-container" class="mt-5">

    </div>
</div>

<script>
    function loadBoard ($key) {
        $.ajax({
           url: '<?= Yii::$app->request->baseUrl. '/board/getboard' ?>',
           type: 'POST',
           data: {
               board_id : $key,
               _csrf : '<?=Yii::$app->request->getCsrfToken()?>',
           },
           success: function (response) {
               $("#board-view-container").html(response).show().fadeIn("slow");
           }
        });
    }
</script>

