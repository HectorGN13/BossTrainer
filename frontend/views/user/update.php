<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\User */

$this->title = 'Mi perfil';

?>

<div class="user-update pt-5">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
</div>