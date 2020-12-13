<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Record */

$this->title = $model->user_id;
$this->params['breadcrumbs'][] = ['label' => 'Records', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="container">
    <div class="record-view">

        <h1><?= Html::encode($this->title) ?></h1>

        <p>
            <?= Html::a('Update', ['update', 'user_id' => $model->user_id, 'movements_id' => $model->movements_id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Delete', ['delete', 'user_id' => $model->user_id, 'movements_id' => $model->movements_id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ]) ?>
        </p>

        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'user_id',
                'movements_id',
                'value',
            ],
        ]) ?>

    </div>
</div>
