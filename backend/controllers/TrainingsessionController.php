<?php

namespace backend\controllers;

use Yii;
use common\models\TrainingSession;
use backend\models\TrainingSessionSearch;
use yii\filters\AccessControl;
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
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['view', 'index', 'create', 'update', 'delete'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
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
        $trainingSessions = TrainingSession::find()->where(['>=', 'start_time',date('Y-m-d 00:00:01')])->andWhere(['<=', 'end_time',date('Y-m-d 23:59:59')]);
        $totalSessionCount = $trainingSessions->count();
        $trainingSessions = $trainingSessions->limit(12)->all();
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'trainingSessions' => $trainingSessions,
            'totalSessionCount' => $totalSessionCount
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
        $html = $this->renderPartial('//trainingsession/view',['trainingSession'=>$trainingSession]);
        echo $html;exit;
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

    public function actiongetdetail()
    {
        $id = Yii::$app->request->post('id');
        echo $id;exit;
    }
    //Carga mas sesiones
    public function actionGetsessions()
    {
        if (Yii::$app->request->isAjax) {
            $row = Yii::$app->request->post('row');
            $currentDay = Yii::$app->request->post('current_day');
            $rowperpage = 10;
            $trainingSessions = TrainingSession::find()->where(['>=', 'start_time',$currentDay.' 00:00:01'])->andWhere(['<=', 'end_time',$currentDay.' 23:59:59'])->andWhere(['=', 'created_by',Yii::$app->user->id])->limit($rowperpage)->offset($row)->all();
            // Comprueba que el usuario siga al gymnasio
            $isUserFollow = GymUser::find()->where(['=', 'user_id', Yii::$app->user->id])->count();
            $html = $this->renderPartial('//trainingsession/load_sessions',['trainingSessions'=>$trainingSessions, 'gym_id' => Yii::$app->user->id, 'is_user_follow_gym' => $isUserFollow > 0]);
            echo $html;exit;
        }
    }
}
