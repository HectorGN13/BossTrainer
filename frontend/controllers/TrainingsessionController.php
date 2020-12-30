<?php

namespace frontend\controllers;

use frontend\models\WaitingList;
use Yii;
use common\models\TrainingSession;
use backend\models\TrainingSessionSearch;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\GymUser;

class TrainingsessionController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all TrainingSession models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new TrainingSessionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $trainingSessions = TrainingSession::find()
            ->where(['>=', 'start_time',date('Y-m-d 00:00:01')])
            ->andWhere(['<=', 'end_time',date('Y-m-d 23:59:59')])
            ->orderBy(['start_time'=>SORT_ASC])
            ->all();
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'trainingSessions' => $trainingSessions
        ]);
    }

    /**
     * Displays a single TrainingSession model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $trainingSession = $this->findModel($id);
        return $this->renderAjax('view',['trainingSession'=>$trainingSession]);

    }

    /**
     * Creates a new TrainingSession model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new TrainingSession();

        if ($model->load(Yii::$app->request->post())) {
            $model->created_by = Yii::$app->user->id;
            $model->save();
            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing TrainingSession model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing TrainingSession model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the TrainingSession model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return TrainingSession the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = TrainingSession::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * @return array|mixed|null
     */
    public function actiongetdetail()
    {
        return Yii::$app->request->post('id');
    }

    /**
     * @return string
     */
    public function actionGetsessions()
    {
        if (Yii::$app->request->isAjax) {
            $gymId = Yii::$app->request->post('gym_id');
            $row = Yii::$app->request->post('row');
            $currentDay = Yii::$app->request->post('current_day');
            $rowPerPage = 10;
            $trainingSessions = TrainingSession::find()
                ->where(['>=', 'start_time',$currentDay.' 00:00:01'])
                ->andWhere(['<=', 'end_time',$currentDay.' 23:59:59'])
                ->andWhere(['=', 'created_by',$gymId])
                ->orderBy(['start_time'=>SORT_ASC])
                ->limit($rowPerPage)
                ->offset($row)
                ->all();

            $isUserFollow = GymUser::find()
                ->where(['=', 'user_id', Yii::$app->user->id])
                ->count();
            return $this->renderPartial('loadsessions',
                ['trainingSessions'=>$trainingSessions, 'gym_id' => $gymId, 'is_user_follow_gym' => $isUserFollow > 0]);
        }
    }

    /**
     * @throws NotFoundHttpException
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
     public function actionAddwaitinglist()
     {
         $waiting_list = new WaitingList();
         $user_id = Yii::$app->user->id;
         $training_session_id = Yii::$app->request->get('id');


         $query = WaitingList::find()->where(['user_id' => $user_id])->andWhere(['training_session_id' => $training_session_id ]);
         if ($query->exists()) {
             WaitingList::findOne(['user_id' => $user_id, 'training_session_id' => $training_session_id])->delete();
             Yii::$app->session->setFlash('success', "Ya no estas en la lista de espera.");
         } else {
             $waiting_list->training_session_id = $training_session_id;
             $waiting_list->user_id = $user_id;

             if ($waiting_list->save()) {
                 Yii::$app->session->setFlash('success',[
                     ['Estas en la lista de espera',
                         'Te has añadido correctamente a la lista de espera, te enviaremos una notificación cuando quede un hueco libre.']]);
             } else {
                 Yii::$app->session->setFlash('error',[
                     ['Error',
                         'Lo sentimos pero algo ha ocurrido mal.']]);
             }
         }

         $this->redirect(['gym/view/', 'id' => self::findModel($training_session_id)->created_by]);
     }
}
