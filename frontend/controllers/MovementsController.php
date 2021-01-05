<?php

namespace frontend\controllers;

use Yii;
use common\models\Movements;
use common\models\MovementsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;


/**
 * MovementsController implementa las acciones de agregar, borrar y editar elementos para el modelo de Movements. Además de implentar
 * las acciones encargadas de renderizar las vistas.
 * MovementsController implements the CRUD actions for Movements model.
 */
class MovementsController extends Controller
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
     * Renderizará un listado de los modelos de movements en función del tipo recibido en la petición get.
     * Lists all Movements models.
     * @return mixed
     */
    public function actionIndex()
    {
        $type = Yii::$app->request->get('type');
        $searchModel = new MovementsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $type);

        switch ($type) {
            case 'benchmark':
                $title = 'Benchmarks';
                break;
            case 'rms':
                $title = 'Repetición a máxima carga.';
                break;
            case 'ability':
                $title = 'Habilidades';
                break;
            case 'mark':
                $title = 'Otras Marcas';
                break;
            default:
                $title = 'Otros';
                break;
        }


        return $this->render('index', [
            'title' => $title,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);

    }


    /**
     * Mostrará un modelo de Movements en conctreto según se le pase por el parámetro id(Clave primaria).
     * Displays a single Movements model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        if (Yii::$app->request->isAjax) {
            return $this->renderAjax('view', [
                'model' => $this->findModel($id),
            ]);
        } else {
            return $this->render('view', [
                'model' => $this->findModel($id),
            ]);
        }
    }

    /**
     * Busca un modelo de Movements en concreto pasándole como parámetro el id (clave primaria).
     * Si no lo encuentra, se lanzará una excepción 404 HTTP.
     * Finds the Movements model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Movements the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Movements::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
