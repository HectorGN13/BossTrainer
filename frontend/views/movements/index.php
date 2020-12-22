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
                        return Html::a(Html::encode($model->title),'#', ['value' => Url::to(['view', 'id' => $model->id]), 'class' => 'movementCard'] );
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
                            ['record/delete'],
                            [
                                'data' => [
                                    'confirm' => '¿Estas seguro de que quieres borrar este elemento?',
                                    'method' => 'post',
                                    'params' => ['movements_id' => $key],
                                ],
                                'class' => 'px-1'
                            ]
                        );

                        $upd = Html::a(Html::tag('span','<i class="fas fa-pen"></i>', ['class' => 'btn btn-sm btn-dark']),
                            '#',
                            ['value' =>Url::to(['record/update', 'movements_id' => $model->id]), 'class' => 'uploadRecord']);


                        $add = Html::a(Html::tag('span','Añadir', ['class' => 'btn btn-sm btn-info']),
                            '#',
                            ['value' =>Url::to(['record/create', 'movements_id' => $model->id]), 'class' => 'addRecord']);

                        return (isset($model->recordsMovements)) ?  $upd . $del : $add;
                    }
                ],
            ]
        ])?>
    </div>
</div>
<?php
Modal::begin([
    'title' => '<h2>Añadir Record.</h2>',
    'id' => 'modalAddRecord',
    // 'size' => 'modal-lg',
]);

echo "<div id='modalContent'></div>";
Modal::end();
?>
<?php
Modal::begin([
    'title' =>'<h2>Actualizar Record.</h2>',
    'id' => 'modalUpdRecord',
    // 'size' => 'modal-lg',
]);

echo "<div id='modalContent'></div>";
Modal::end();
?>
<?php
Modal::begin([
    'id' => 'modalMovement',
    // 'size' => 'modal-lg',
]);

echo "<div id='modalContent'></div>";
Modal::end();
?>
