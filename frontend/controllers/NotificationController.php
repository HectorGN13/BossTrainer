<?php

namespace frontend\controllers;

use Yii;
use common\models\Notification;
use common\models\NotificationSearch;
use yii\data\ActiveDataProvider;
use yii\db\ActiveQuery;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * NotificationController implements the CRUD actions for Notification model.
 */
class NotificationController extends Controller
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
     * Lists all Notification models.
     * @return mixed
     */
    public function actionIndex()
    {
        $userId = Yii::$app->user->id;
        $searchModel = new NotificationSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $notifications = Notification::find()
            ->where(['=', 'recipient',$userId])
            ->orderBy(['created_at'=>SORT_DESC]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'notifications' => $notifications,
        ]);
    }

    /**
     * Displays a single Notification model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView()
    {
        $notification_id = Yii::$app->request->post('id');

        if(Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            return ActiveForm::validate($model);
        }

        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'Se ha actualizado con éxito su record.');
                return $this->redirect(['view', 'movements_id' => $model->movements_id]);
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


        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Deletes an existing Notification model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete()
    {
        $notification_id = Yii::$app->request->post('id');
        if ($this->findModel($notification_id)->delete() != false ) {
            Yii::$app->session->setFlash('success', 'Se ha borrado con éxito.');
            return $this->redirect(['notification/index']);
        } else {
            Yii::$app->session->setFlash('error', 'Upss. Algo ha ocurrido mal.');
            return $this->redirect(['notification/index']);
        }
    }

    /**
     * Finds the Notification model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Notification the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Notification::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionNotifications () {
        $userId = Yii::$app->user->id;
        $searchModel = new NotificationSearch();

        $query = Notification::find()
            ->where(['=', 'recipient',$userId])
            ->orderBy(['created_at'=>SORT_DESC]);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (Yii::$app->request->isAjax) {
            return $this->renderAjax('index', [
                'dataProvider' => $dataProvider,
                'searchModel' => $searchModel,
            ]);
        } else {
            return $this->render('index', [
                'dataProvider' => $dataProvider,
                'searchModel' => $searchModel,
            ]);
        }

    }
}
