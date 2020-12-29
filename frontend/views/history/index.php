<?php

use yii\helpers\Html;
use yii\grid\GridView;

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
                [
                    'header' => 'Nombre de la sesión',
                    'content' => function ($model, $key, $index, $widget) {
                       // return
                    }
                ],
                [
                    'header' => 'Gimnasio',
                    'content' => function ($model, $key, $index, $widget) {
                        // return
                    }
                ],
                [
                    'header' => 'Fecha',
                    'content' => function ($model, $key, $index, $widget) {
                        // return
                    }
                ],
                [
                    'header' => 'Calificación',
                    'content' => function ($model, $key, $index, $widget) {
                        // return
                    }
                ],
        ],
    ]); ?>

    </div>
</div>
