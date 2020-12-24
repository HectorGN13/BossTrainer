<?php

namespace frontend\controllers;


use common\models\GymUser;
use DateTime;
use Yii;
use common\models\Gym;
use common\models\GymSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\TrainingSession;
use common\models\UserTrainingSession;

/**
 * GymController implements the CRUD actions for Gym model.
 */
class GymController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Gym models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new GymSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Gym model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $searchModel = new GymSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $trainingSessions = TrainingSession::find()->where(['>=', 'start_time',date('Y-m-d 00:00:01')])->andWhere(['<=', 'end_time',date('Y-m-d 23:59:59')])->andWhere(['=', 'created_by',$id]);
        $totalSessionCount = $trainingSessions->count();
        $trainingSessions = $trainingSessions->limit(12)->all();
        return $this->render('view', [
            'model' => $this->findModel($id),
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'trainingSessions' => $trainingSessions,
            'totalSessionCount' => $totalSessionCount,
            'gym_id' => $id
        ]);
    }

    /**
     * Creates a new Gym model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Gym();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Gym model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Gym model.
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
     * Finds the Gym model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Gym the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Gym::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     */
    public function actionFollow()
    {
        $follow = new GymUser();
        $user_id = Yii::$app->user->id;
        $gym_id = Yii::$app->request->get('id');

        $query = GymUser::find()->where(['user_id' => $user_id])->andWhere(['gym_id' => $gym_id ]);
        if ($query->exists()) {
            GymUser::findOne(['user_id' => $user_id, 'gym_id' => $gym_id])->delete();
        } else {
            $follow->gym_id = $gym_id;
            $follow->user_id = $user_id;
            
            $follow->save();
        }

        $this->redirect(['gym/view/', 'id' => $gym_id]);
    }

    /**
     * @return \yii\web\Response
     */
    public function actionJoin()
    {
        $useTrainingSession = new UserTrainingSession();
        $userId = Yii::$app->user->id;
        $trainingSessionId = Yii::$app->request->get('id');
        $userCount = UserTrainingSession::find()->where(['user_id' => $userId, 'training_session_id' => $trainingSessionId])->count();
        if($userCount < 1)
        {
            $useTrainingSession->user_id = $userId;
            $useTrainingSession->training_session_id = $trainingSessionId;
            $useTrainingSession->save();
            Yii::$app->session->setFlash('success', "Te has unido correctamente.");
            return $this->goBack((!empty(Yii::$app->request->referrer) ? Yii::$app->request->referrer : null));
        }
        else
        {
            Yii::$app->session->setFlash('error', "Ya estabas unido/a a esta sesion de entrenamiento.");
            return $this->goBack((!empty(Yii::$app->request->referrer) ? Yii::$app->request->referrer : null));
        }
    }

    public function actionLeave($id)
    {
        $userId = Yii::$app->user->id;
        $useTrainingSession = UserTrainingSession::find()->where(['user_id' => $userId, 'training_session_id' => $id])->one()->delete();
        Yii::$app->session->setFlash('success', "Te has salido de la sesión de entrenamiento correctamente.");
        return $this->goBack((!empty(Yii::$app->request->referrer) ? Yii::$app->request->referrer : null));
    }
}
