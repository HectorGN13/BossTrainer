<?php

use common\models\Gym;
use common\models\TrainingSession;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\UserTrainingSessionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Mi Historial';
?>
<div class="history-index pt-5">
    <div class="history-list container">
        <div class="lines-effect">
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
                    'attribute' => 'ID de la sesión',
                    'value' => 'id',
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
                        // return
                    },
                    'enableSorting' => true,
                ],
        ],
    ]); ?>

    </div>
</div>
