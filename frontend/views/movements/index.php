<?php

use yii\grid\GridView;
use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $searchModel common\models\MovementsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $title frontend\controllers\MovementsController */

$this->title = $title;
?>
<div class="movements-index pt-5">
    <div class="movements-list container">
        <div class="lines-effect">
            <h1 class="text-responsive" style="text-transform: uppercase"><?= Html::encode($this->title) ?></h1>
        </div>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'options' => ['class' => 'custom-table'],
            'layout' => '{items}{pager}',
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
                    'header' => 'Acciones',
                    'content' => function ($model, $key, $index, $widget) {
                        $del =  Html::a(Html::tag('span','<i class="fas fa-trash-alt"></i>', ['class' => 'btn btn-sm btn-danger']),
                            ['record/delete', 'user_id' => Yii::$app->user->id, 'movements_id' => $model->id],
                            ['data-method' => 'POST',  'class' => 'px-1']);

                        $upd = Html::a(Html::tag('span','<i class="fas fa-pen"></i>', ['class' => 'btn btn-sm btn-dark']),
                            ['record/update', 'user_id' => Yii::$app->user->id, 'movements_id' => $model->id],
                            ['data-method' => 'POST', 'class' => 'px-1']);


                        $add = Html::a(Html::tag('span','Añadir', ['class' => 'btn btn-sm btn-success']),
                            ['record/create', 'user_id' => Yii::$app->user->id, 'movements_id' => $model->id],
                            ['data-method' => 'POST']);

                        return (isset($model->recordsMovements)) ?  $upd . $del : $add;


                    }
                ],
            ]
        ])?>
    </div>
</div>