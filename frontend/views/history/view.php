<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model frontend\models\UserTrainingSession */

$this->title = $model->id;
\yii\web\YiiAsset::register($this);
?>
<div class="container">
    <div class="user-training-session-view">
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'id',
                'user_id',
                'training_session_id',
            ],
        ]) ?>
    </div>
</div>

