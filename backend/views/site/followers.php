<?php

use backend\assets\BoardAsset;
use backend\models\Rate;
use kartik\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\GymUserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Usuarios';
BoardAsset::register($this);
?>
<div class="gymuser-index">
	<div class="board-list container mb-5">
		<div class="lines-effect">
            <h1 class="text-responsive" style="text-transform: uppercase"><?= Html::encode($this->title) ?></h1>
        </div>
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
                    'attribute' => 'user_id',
                    'label' => 'Nombre de usuario',
                    'value' => 'user.username'
                ],
	            [
                     'attribute' => 'user_id',
                     'label' => 'Nombre completo',
                     'value' => 'user.name'
				],
                [
                    'attribute' => 'user_id',
                    'label' => 'email',
                    'value' => 'user.email'
                ],
                [
                    'header' => 'Acciones',
                    'content' => function ($model, $key, $index, $widget) {
                        $del =  Html::a(Html::tag('span','<i class="fas fa-trash-alt"></i>', ['class' => 'btn btn-sm btn-danger']),
                            ['deleterate'],
                            [
                                'data' => [
                                    'confirm' => '¿Estas seguro de que quieres borrar esta Tarifa?',
                                    'method' => 'post',
                                    'params' => ['rate_id' => $model->user_id],
                                ],
                                'class' => 'px-1'
                            ]
                        );

                        $upd = Html::a(Html::tag('span','<i class="fas fa-pen"></i>', ['class' => 'btn btn-sm btn-dark']),
                            ['updaterate', 'user_id' => $model->user_id]);


                        $add = Html::a(Html::tag('span','Añadir', ['class' => 'btn btn-sm btn-info']),
                            ['site/assignrate', 'id' => $model->user_id],
                            ['id'=>'btn-assign-rate', 'data-userid'=>$model->user_id]);

                        return (Rate::findOne(['user_id' => $model->user_id]) !== null ) ?  $upd . $del : $add;
                    }
                ],
	        ]
	    ]); ?>
	</div>
</div>