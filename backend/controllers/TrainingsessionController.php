<?php

namespace backend\controllers;

use Yii;
use common\models\TrainingSession;
use backend\models\TrainingSessionSearch;
use yii\web\Response;
use yii\bootstrap4\ActiveForm;
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
        $trainingSessions = TrainingSession::find()
            ->where(['>=', 'start_time',date('Y-m-d 00:00:01')])
            ->andWhere(['<=', 'end_time',date('Y-m-d 23:59:59')])
            ->orderBy(['start_time'=>SORT_ASC]);
        $totalSessionCount = $trainingSessions->count();
        $trainingSessions = $trainingSessions->limit(10)->all();
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

        if(Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }
        if ($model->load(Yii::$app->request->post())) {
            $model->created_by = Yii::$app->user->id;
            $model->save();
            return $this->redirect(['index']);
        }

        if (Yii::$app->request->isAjax) {
            return $this->renderAjax('create', [
                'model' => $model,
            ]);
        }else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
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
        if(Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }

        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'Se ha actualizado con éxito su record.');
                return $this->redirect(['index']);
            } else {
                Yii::$app->session->setFlash('error', 'Upss. Algo ha ocurrido mal.');
            }
        }

        if (Yii::$app->request->isAjax) {
            return $this->renderAjax('update', [
                'model' => $model,
            ]);
        }else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
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
        return Yii::$app->request->post('id');
    }


    /**
     * Obtiene las sesiones de entrenamiento del dia actual.
     * @return string
     */
    public function actionGetsessions()
    {
        if (Yii::$app->request->isAjax) {
            $row = Yii::$app->request->post('row');
            $currentDay = Yii::$app->request->post('current_day');
            $rowPerPage = 10;
            $trainingSessions = TrainingSession::find()
                ->where(['>=', 'start_time',$currentDay.' 00:00:01'])
                ->andWhere(['<=', 'end_time',$currentDay.' 23:59:59'])
                ->andWhere(['=', 'created_by',Yii::$app->user->id])
                ->orderBy(['start_time'=>SORT_ASC])
                ->limit($rowPerPage)
                ->offset($row)
                ->all();


            $isUserFollow = GymUser::find()
                ->where(['=', 'user_id', Yii::$app->user->id])
                ->count();

            return $this->renderPartial('sessions',
                ['trainingSessions'=>$trainingSessions, 'gym_id' => Yii::$app->user->id, 'is_user_follow_gym' => $isUserFollow > 0]);
        }
    }
}
