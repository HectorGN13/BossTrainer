<?php

namespace frontend\controllers;

use Yii;
use frontend\models\UserTrainingSession;
use frontend\models\UserTrainingSessionSearch;
use yii\data\ActiveDataProvider;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * History implementa las acciones de agregar, borrar y editar elementos para el modelo de UserTrainingSession. Además de implentar
 * las acciones encargadas de renderizar las vistas.
 * History implements the CRUD actions for UserTrainingSession model.
 */
class HistoryController extends Controller
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
     * Muestra la vista un listado de todas las sesiones de entrenamientos en las que ha participado el usuario conectado.
     * Lists all UserTrainingSession models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new UserTrainingSessionSearch();
        $dataProvider = new ActiveDataProvider([
            'query' =>UserTrainingSession::find()->where(['user_id' => Yii::$app->user->identity->id]),
        ]);;

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Muestra la vista de una sesion de entrenamiento en concreto pasando como parametro el id (clave primaria) de la UserTrainingSession.
     * Displays a single UserTrainingSession model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Modifica un modelo existente de UserTrainingSession.
     * Si se ha modificado con éxito, el navegador te redireccionará a la vista de esa UserTrainingSession.
     * Updates an existing UserTrainingSession model.
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
     * Busca una UserTrainingSession en concreto pasandole como parametro el id (clave primaria).
     * Si no lo encuentra, se lanzará una excepción 404 HTTP.
     * Finds the UserTrainingSession model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return UserTrainingSession the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = UserTrainingSession::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }


    /**
     * Está acción modificará la columna de rating del modelo. Y mandará una respuesta en formato JSON con los datos de rating.
     * En el caso de que no se modifique, la respuesta que se enviará será un false.
     */
    public function actionRating()
    {
        $response['success'] = false;
        $id = Yii::$app->request->post('id');
        $model = $this->findModel($id);

        if (Yii::$app->request->post()){
            $request = Yii::$app->request->post();
            $model->rating = intval($request['rate']);
            $model->save();
            $newRating = $model->rating;
            $response['rating'] = intval($newRating);
            $response['success'] = true;
        }
        echo Json::encode($response);
        Yii::$app->end();
    }
}
