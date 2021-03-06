<?php

namespace frontend\controllers;


use Yii;
use common\models\Record;
use common\models\RecordSearch;
use yii\bootstrap4\ActiveForm;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;

/**
 * RecordController implementa las acciones de agregar, borrar y editar elementos para el modelo de Records. Además de implentar
 * las acciones encargadas de renderizar las vistas.
 * RecordController implements the CRUD actions for Record model.
 */
class RecordController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['update', 'delete', 'create'],
                'rules' => [
                    [
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
     * Renderizará un listado de los modelos de Record.
     * Lists all Record models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new RecordSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Mostrará un modelo de Movement en concreto según el id que reciba por la petición post.
     * Displays a single Record model.
     * @param integer $movements_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($movements_id)
    {
        return $this->render('view', [
            'model' => $this->findModel( $movements_id),
        ]);
    }

    /**
     * Crea un nuevo modelo de Record.
     * En el caso de que la creación haga efecto el navegador te redirecciona a la vista de ese record
     * Creates a new Record model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Record();

        $model->user_id = Yii::$app->user->identity->id;
        $model->movements_id = Yii::$app->request->get('movements_id');
        if(Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }

        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'Se ha añadido con éxito su record.');
                return $this->goBack();
            } else {
                Yii::$app->session->setFlash('error', 'Upss. Algo ha ocurrido mal.');
            }
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
     * Modifica un modelo existenten de Record según el movimiento id que se le pase por parámetro.
     * Updates an existing Record model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $movements_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($movements_id)
    {
        $model = $this->findModel($movements_id);
        if(Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }

        if ($model->load(Yii::$app->request->post())) {
           if ($model->save()) {
                Yii::$app->session->setFlash('success', 'Se ha actualizado con éxito su record.');
                return $this->goBack();
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
     * Borra un Modelo existente de Record.
     * Si el borrado se realiza con éxito el navegador te redireccionará a un index donde todos los movimientos se mostrarán.
     * Deletes an existing Record model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete()
    {
        $movements_id = Yii::$app->request->post('movements_id');
        if ($this->findModel($movements_id)->delete() != false ) {
            Yii::$app->session->setFlash('success', 'Se ha borrado con éxito su record.');
            return $this->redirect(['movements/index']);
        } else {
            Yii::$app->session->setFlash('error', 'Upss. Algo ha ocurrido mal.');
            return $this->redirect(['movements/index']);
        }
    }

    /**
     * Encuentra un modelo de Record en concreto, segun el id (Clave primaria) que se le pase por parámetro.
     * Finds the Record model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $movements_id
     * @return Record the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($movements_id)
    {
        if (($model = Record::findOne(['user_id' => Yii::$app->user->identity->id, 'movements_id' => $movements_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    
}
