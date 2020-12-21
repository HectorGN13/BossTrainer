<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\TrainingSessionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Sesiones de Entreno';
?>
<div class="training-session-index">
        <div class="training-session-list container">
            <div class="lines-effect">
                <h1 class="text-responsive" style="text-transform: uppercase"><?= Html::encode($this->title) ?></h1>
            </div>


        <?php echo $this->render('_search', ['model' => $searchModel]); ?>
            <p>
                <?= Html::a('Crear sesión', ['create'], ['class' => 'btn btn-success']) ?>
            </p>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                'title',
                'description:ntext',
                'start_time',
                'end_time',
                'capacity',
                //'created_by',
                [
                    'label' => 'Users',
                    'value' => function ($model) {
                        $userNameArr = array();
                        foreach($model->getUserTrainingSessions() as $user)
                        {
                            array_push($userNameArr, $user->user->username);
                        }
                        return implode(', ', $userNameArr);
                    }
                ],
                [
                    'class' => 'yii\grid\ActionColumn',
                    'header' => 'Actions',
                    'headerOptions' => ['style' => 'color:#337ab7'],
                    'template' => '{update}{delete}',
                    'buttons' => [
                        'update' => function ($url, $model) {
                            return Html::a('<span class="glyphicon glyphicon-pencil"></span>', $url, [
                                'title' => 'Edit',
                                'class' => 'btn btn-primary'
                            ]);
                        },
                        'delete' => function ($url, $model) {
                            return Html::a('<span class="glyphicon glyphicon-trash"></span>', $url, [
                                'title' => 'Delete',
                                'class' => 'btn btn-danger ml-1',
                                'data' => [
                                    'method' => 'post',
                                    // use it if you want to confirm the action
                                    'confirm' => 'Are you sure?',
                                ],
                            ]);
                        }

                    ],
                ],
            ],
        ]); ?>
    </div>
</div>
