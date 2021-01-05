<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Notification */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Notifications', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="notification-view container mt-5 pt-5">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'title',
            'body:ntext',
            'created_at',
        ],
    ]) ?>

</div>
