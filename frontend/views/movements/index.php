<?php

use frontend\assets\MovementsAssets;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap4\Modal;

/* @var $this yii\web\View */
/* @var $searchModel common\models\MovementsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $title frontend\controllers\MovementsController */

$this->title = $title;
MovementsAssets::register($this);
?>
<div class="movements-index pt-5">
    <div class="movements-list container">
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
                            '#',
                            ['value' =>Url::to(['record/update', 'user_id' => Yii::$app->user->id, 'movements_id' => $model->id]), 'id' => 'uploadRecord']);


                        $add = Html::a(Html::tag('span','Añadir', ['class' => 'btn btn-sm btn-success']),
                            '#',
                            ['value' =>Url::to(['record/create', 'user_id' => Yii::$app->user->id, 'movements_id' => $model->id]), 'id' => 'addRecord']);

                        return (isset($model->recordsMovements)) ?  $upd . $del : $add;


                    }
                ],
            ]
        ])?>
    </div>
</div>
<?php
Modal::begin([
    'title' => (isset($model->recordsMovements)) ? '<h2>Actualizar Record.</h2>' : '<h2>Añadir Record.</h2>',
    'id' => 'modalRecord',
    // 'size' => 'modal-lg',
]);

echo "<div id='modalContent'></div>";
Modal::end();
?>