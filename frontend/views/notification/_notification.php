<?php

use yii\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;

$url = Url::to(['notification/notifications']);


$js = <<< EOT
$(notifications).ready(function() {
    setInterval(function() {
      $.pjax.load({container:'#notifications'});
    }, 5000); 
});
EOT;

$this->registerJs($js);

?>
    <h1><?= Html::encode($this->title) ?></h1>
    <?php  ?>
    <?php Pjax::begin([]); ?>

    <?= GridView::widget([
            'id' => 'notifications',
            'dataProvider' => $dataProvider,
            'columns' => [
                'title',
                'body',
                'created_at',
                'read',
            ],
        ]);
    ?>

    <?php Pjax::end(); ?>
