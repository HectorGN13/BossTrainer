<?php

use common\models\Gym;
use common\models\TrainingSession;
use kartik\grid\GridView;
use kartik\rating\StarRating;
use yii\helpers\Html;
use yii\helpers\Url;


/* @var $this yii\web\View */
/* @var $searchModel frontend\models\UserTrainingSessionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Mi Historial';

?>
<script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js" crossorigin="anonymous"></script>
<div class="history-index pt-5">
    <div class="history-list container">
        <div class="lines-effect" data-animation="zoomIn">
            <h1 class="text-responsive" style="text-transform: uppercase"><?= Html::encode($this->title) ?></h1>
        </div>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'options' => ['class' => 'custom-table'],
            'tableOptions' => ['class' => 'table table-hover table-sm'],
            'layout' => '{items}{pager}',
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                [
                    'header' => 'ID',
                    'content' => function ($model, $key, $index, $widget) {
                        return Html::encode($model->id);
                    },
                    'enableSorting' => true,
                ],
                [
                    'header' => 'Nombre de la sesión',
                    'content' => function ($model, $key, $index, $widget) {
                        $trainingSession = TrainingSession::findOne($model->training_session_id);
                        return Html::encode($trainingSession->title);
                    },
                    'enableSorting' => true,
                ],
                [
                    'header' => 'Gimnasio',
                    'content' => function ($model, $key, $index, $widget) {
                        $trainingSession = TrainingSession::findOne($model->training_session_id);
                        $gym = Gym::findOne($trainingSession->created_by);
                        return Html::a(Html::encode($gym->name), ['gym/view', 'id' => $trainingSession->created_by]);

                    },
                    'enableSorting' => true,
                ],
                [
                    'header' => 'Fecha',
                    'content' => function ($model, $key, $index, $widget) {
                        $trainingSession = TrainingSession::findOne($model->training_session_id);
                        $date = new DateTime($trainingSession->start_time);
                        return Html::encode($date->format('d/m/Y H:i:s'));
                    },
                    'enableSorting' => true,
                ],
                [
                    'header' => 'Calificación',
                    'content' => function ($model, $key, $index, $widget) {

                        return StarRating::widget([

                            'model' => $model,
                            'attribute' => 'rating',
                            'value' => $model->rating,

                            'options' => ['id' => 'rating-'.$key],

                            'pluginOptions' => [
                                'showClear' => false,
                                'showCaption' => false,
                                'format' => 'raw',
                                'theme' => 'krajee-uni',
                                'filledStar' => '&#x2605;',
                                'emptyStar' => '&#x2606;'

                            ],
                            'pluginEvents' => [
                                'rating:change' => "function(event, value, caption){
                                    $.ajax({
                                        url:'rating',
                                        method:'post',
                                        data:{rate:value, id:'$model->id'},
                                        dataType:'json',
                                        success:function(data){
                                            $(event.currentTarget).rating('update',data.rating);
                                        }
                                    });
                                }"
                            ]
                        ]);
                    },
                    'enableSorting' => true,
                ],
        ],
    ]); ?>
    </div>
</div>
