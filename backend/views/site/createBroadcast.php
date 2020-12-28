<?php

/* @var $this yii\web\View */
/* @var $model common\models\Notification */

use yii\helpers\Html;

$this->title = 'Mensaje de difusión';
?>
<div class="board-index">
    <div class="board-list container mb-5">
        <div class="lines-effect">
            <h1 class="text-responsive" style="text-transform: uppercase"><?= Html::encode($this->title) ?></h1>
        </div>
        <div class="weight-create">
            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>
        </div>
    </div>
</div>
