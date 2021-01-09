<?php

namespace frontend\controllers;


use backend\models\Rate;
use common\models\Board;
use common\models\GymUser;
use DateTime;
use Yii;
use common\models\Gym;
use common\models\GymSearch;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\TrainingSession;
use common\models\UserTrainingSession;
use yii\web\Response;

/**
 * GymController implementa las acciones de agregar, borrar y editar elementos para el modelo de Gym. Además de implentar
 * las acciones encargadas de renderizar las vistas.
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
     * Muestra la vista de todos los gimnasios cargadon un scroll infinito.
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
     * Listado de los gimnasios a los que un usuario se ha unido.
     * Lists my Gym models.
     * @return mixed
     */
    public function actionMygyms()
    {
        $searchModel = new GymSearch();
        $query = Gym::find()
            ->joinWith('gymUsers u');

        $query->filterWhere(['=','u.user_id', intval(Yii::$app->user->id)]);
        $dataProvider = new ActiveDataProvider([
                'query' => $query
        ]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Muestra el modelo de un gimnasio en concreto, según se le pase por id.
     * Displays a single Gym model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $searchModel = new GymSearch();
        $model = $this->findModel($id);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $trainingSessions = TrainingSession::find()->where(['>=', 'start_time',date('Y-m-d 00:00:01')])->andWhere(['<=', 'end_time',date('Y-m-d 23:59:59')])->andWhere(['=', 'created_by',$id]);
        $totalSessionCount = $trainingSessions->count();
        $trainingSessions = $trainingSessions->limit(10)->all();
        $boardDefault = Board::findOne($model->default_board);
        return $this->render('view', [
            'model' => $model,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'trainingSessions' => $trainingSessions,
            'totalSessionCount' => $totalSessionCount,
            'default_board' => $boardDefault,
            'gym_id' => $id
        ]);
    }

    /**
     * Crea un nuevo modelo de gimnasio. En el caso de que la creación haga efecto el navegador te redirecciona a la
     * vista de ese gimnasio
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
     * Modifica un modelo de Gym ya existente. Si la modificación se realiza con éxito el navegador te redirigirá a la
     * página de la vista del Modelo.
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
     * Elimina un modelo de Gym ya existente. Si la eliminación se realiza con éxito el navegador te redirigirá a la
     * página Index de gimnasios.
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
     * Encunetra el modoelo según el id que le pases al método. Es decir buscaría por su clave primaria.
     * Si el modelo no se encuentra se lanzará una excepcion 404 HTTP. Indicando que la página requerida no existe.
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
     * Crea un nuevo modelo de GymUser. En el caso de que ya exista se elimina.
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
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
     * Crea un nuevo modelo de UserTrainingSession. En el caso de que sea posible, es decir si tu tarifa no ha terminado.
     * @return Response
     */
    public function actionJoin()
    {
        $ok = false;
        $useTrainingSession = new UserTrainingSession();
        $userId = Yii::$app->user->id;
        $trainingSessionId = intval(Yii::$app->request->get('id'));

        $gym = TrainingSession::findOne(['id' => $trainingSessionId]);
        $follow = GymUser::find()->where(['user_id' => $userId, 'gym_id' => $gym['created_by']])->exists();

        $userCount = UserTrainingSession::find()
            ->where(['user_id' => $userId, 'training_session_id' => $trainingSessionId])
            ->count();

        $rate = Rate::find()->joinWith('type0 t')->where(['user_id' => $userId, 't.gym_id' => $gym['created_by']])->one();
        if (isset($rate)){
            $ok = !($rate->isRateExpired($gym['created_by'],$userId));
        }

        if ($follow && $ok){
            if($userCount < 1) {
                $useTrainingSession->user_id = $userId;
                $useTrainingSession->training_session_id = $trainingSessionId;
                $useTrainingSession->save();
                Yii::$app->session->setFlash('success', "Te has unido correctamente.");
                return $this->goBack((!empty(Yii::$app->request->referrer) ? Yii::$app->request->referrer : null));
            }
            else {
                Yii::$app->session->setFlash('error', "Ya estabas unido/a a esta sesion de entrenamiento.");
                return $this->goBack((!empty(Yii::$app->request->referrer) ? Yii::$app->request->referrer : null));
            }
        } else {
            Yii::$app->session->setFlash('error', "No puedes unirte a esta sesión de entrenamiento.");
            return $this->goBack((!empty(Yii::$app->request->referrer) ? Yii::$app->request->referrer : null));
        }

    }

    /**
     * Elimina el modelo UserTrainingSession.
     * @param $id
     * @return Response
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionLeave($id)
    {
        $userId = Yii::$app->user->id;
        $useTrainingSession = UserTrainingSession::find()
            ->where(['user_id' => $userId, 'training_session_id' => $id])
            ->one()
            ->delete();
        Yii::$app->session->setFlash('success', "Te has salido de la sesión de entrenamiento correctamente.");
        return $this->goBack((!empty(Yii::$app->request->referrer) ? Yii::$app->request->referrer : null));
    }
}
