<?php

use macgyer\yii2materializecss\widgets\grid\ActionColumn;
use yii\grid\GridView;
use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $searchModel common\models\MovementsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $title frontend\controllers\MovementsController */

$this->title = $title;
?>
<div class="movements-index pt-5">
    <div class="movements-list container pt-5">
        <h1 class="py-4"><?= Html::encode($this->title) ?></h1>

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'layout' => '{items}',
            'columns' => [
                [
                    'header' => 'Ejercicio',
                    'content' => function ($model, $key, $index, $widget) {
                        return Html::a(Html::encode($model->title), ['view', 'id' => $model->id]);
                    }
                ],
                [
                    'header' => 'Mi Record',
                    'content' => function ($model, $key, $index, $widget) {
                      return Html::tag('span',
                          !empty($model->recordsMovements) ? $model->recordsMovements . $model->getTypeMeasure() : '',
                            ['class' => 'badge badge-pill badge-warning']) ;
                      }
                ],
                [
                    'header' => 'Añadir Record',
                    'content' => function ($model, $key, $index, $widget) {
                        return Html::a(Html::tag('span',
                            'editar'),
                            (isset($model->recordsMovements))
                                ? ['record/update', 'user_id' => Yii::$app->user->id, 'movements_id' => $model->id]
                                : ['record/create', 'user_id' => Yii::$app->user->id, 'movements_id' => $model->id]);
                    }
                ]
            ]
        ]) ?>
    </div>
</div>