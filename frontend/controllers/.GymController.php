<?php

namespace frontend\controllers;

use common\models\Gym;

class GymController extends \yii\web\Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionGymlist()
    {
        $gyms = Gym::find()->all();
        return $this->render('gymlist', ['gyms' => $gyms]);
    }
}
