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
 * NotificationController implementa las acciones de agregar, borrar y editar elementos para el modelo de Movements.
 * Además de implentar las acciones encargadas de renderizar las vistas.
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
     * Renderizará un listado de los modelos de Notification según el usuario que este conectado en ese momento.
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
     * Mostrará un modelo de Notification en concreto según el id que reciba por la petición post.
     * Displays a single Notification model.
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView()
    {
        $notification_id = Yii::$app->request->post('id');
        $model = $this->findModel($notification_id);
        $model->read = 9;
        if ($model->save()) {
            return $this->render('view', [
                'model' => $this->findModel($notification_id),
            ]);
        } else {
            Yii::$app->session->setFlash('error', 'Upss. Algo ha ocurrido mal.');
             return $this->goHome();
        }
    }

    /**
     * Borrará un Modelo de Notification existente, si el borrado se hace correctamente el navegador redireccionará al index de notification
     * Deletes an existing Notification model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
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
     * Busca un modelo de Notification en concreto pasándole como parámetro el id (clave primaria).
     * Si no lo encuentra, se lanzará una excepción 404 HTTP.
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

    /**
     * Muestra un modelo de notificación en concreto y además modifica el atributo read una vez renderizado marcandolo como leído.
     * Displays a single Notification model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionRead()
    {
        $notification_id = Yii::$app->request->post('id');
        $model = $this->findModel($notification_id);
        if ( $model->read == 10) {
            $model->read = 9;
        } else {
            $model->read = 10;
        }

        if ($model->save()) {
            return $this->redirect(['notification/index']);
        } else {
            Yii::$app->session->setFlash('error', 'Upss. Algo ha ocurrido mal.');
            return $this->goHome();
        }
    }
}
