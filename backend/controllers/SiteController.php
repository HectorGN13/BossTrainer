<?php
namespace backend\controllers;

use backend\models\TrainingSessionSearch;
use common\models\Gym;
use common\models\GymUser;
use common\models\Notification;
use common\models\TrainingSession;
use frontend\models\UserTrainingSession;
use frontend\models\Weight;
use frontend\models\WeightSeach;
use RecursiveArrayIterator;
use RecursiveIteratorIterator;
use Yii;
use yii\bootstrap4\ActiveForm;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use common\models\Provincias;
use common\models\Localidades;
use yii\helpers\ArrayHelper;
use backend\models\GymUserSearch;
use backend\models\Rate;


/**
 * Site controller
 */
class SiteController extends Controller
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
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => [
                            'logout',
                            'index',
                            'broadcast',
                            'invoice',
                            'pdf',
                            'settings',
                            'getprovincia',
                            'getlocalidades',
                            'view',
                            'followers',
                            'assignrate',
                            'updaterate',
                            'deleterate',
                        ],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new TrainingSessionSearch();
        $dataProvider = new ActiveDataProvider([
            'query' => TrainingSession::find()
                ->where(['created_by' =>  Yii::$app->user->identity->id ])
                ->andWhere(['>=', 'start_time',date('Y-m-d 00:00:01')])
                ->andWhere(['<=', 'end_time',date('Y-m-d 23:59:59')])
                ->orderBy(['start_time'=>SORT_ASC]),
            'sort' => ['attributes' => ['start_time']],
        ]);

        $ocupation = TrainingSession::find()
                ->select('count(ut.user_id) AS counter')
                ->where(['created_by' =>  Yii::$app->user->identity->id ])
                ->andWhere(['>=', 'start_time',date('Y-m-d 00:00:01')])
                ->andWhere(['<=', 'end_time',date('Y-m-d 23:59:59')])
                ->alias('t')
                ->joinWith('uTSessions ut')
                ->groupBy(['t.id'])
                ->indexBy('id')
                ->column();

        $it = new RecursiveIteratorIterator(new RecursiveArrayIterator($ocupation));
        foreach($it as $v) {
            $counter[] = $v;
        }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'ocupation' => $counter,
        ]);
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $this->layout = 'blank';

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            $model->password = '';

            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }


    /**
     * @return string
     */
    public function actionBroadcast()
    {
        $model = new Notification();
        if ($model->load(Yii::$app->request->post())) {
            $var = false;
            $recipients = GymUser::find()
                ->where(['gym_id' => Yii::$app->user->id])
                ->all();

            foreach ($recipients as $recipient) {
                $model->recipient = $recipient['user_id'];
                 if ($model->save()) {
                     $var = true;
                 }
            }

            if ($var) {
                Yii::$app->session->setFlash('success', 'Su mensaje se ha difundido con éxito.');
            } else {
                Yii::$app->session->setFlash('error', 'Upss. Algo ha ocurrido mal.');
            }
            return $this->redirect(['index']);
        }

        return $this->render('createBroadcast', [
            'model' => $model,
        ]);
    }

    /**
     * @return string
     */
    public function actionInvoice()
    {
        return $this->render('invoice',[
            'model' => Gym::findOne(Yii::$app->user->id),
        ]);
    }

    /**
     * @return string|Response
     * @throws NotFoundHttpException
     */
    public function actionSettings()
    {
        $model = $this->findModel(Yii::$app->user->id);

        if ($model->load(Yii::$app->request->post()) &&  $model->validate()) {
            $avatarImage = Yii::$app->request->post('hidden_profile_img');
            if(isset($_FILES['Gym']) && !empty($_FILES['Gym']['name']['profile_img']))
            {
                $file = $_FILES['Gym'];
                $temp = explode(".", $_FILES['Gym']['name']['profile_img']);
                $file_name = round(microtime(true)) . '.' . end($temp);
                $temp_file_location = $file['tmp_name']['profile_img'];
                Yii::$app->awssdk->region = 'eu-central-1';
                $aws = Yii::$app->awssdk->getAwsSdk();

                $s3 = $aws->createS3();
                $result = $s3->putObject([
                    'ACL' => 'public-read',
                    'Bucket' => 'bosstrainer1',
                    'Key'    => $file_name,
                    'SourceFile' => $temp_file_location
                ]);
                if($result['@metadata']['statusCode'] == 200)
                    $avatarImage =  isset($result['ObjectURL']) ? $result['ObjectURL'] : '';
            }
            $bannerImage = Yii::$app->request->post('hidden_banner_img');
            if(isset($_FILES['Gym']) && !empty($_FILES['Gym']['name']['banner_img']))
            {
                $file = $_FILES['Gym'];
                $temp = explode(".", $_FILES['Gym']['name']['banner_img']);
                $file_name = round(microtime(true)) . '.' . end($temp);
                $temp_file_location = $file['tmp_name']['banner_img'];
                Yii::$app->awssdk->region = 'eu-central-1';
                $aws = Yii::$app->awssdk->getAwsSdk();

                $s3 = $aws->createS3();
                $result = $s3->putObject([
                    'ACL' => 'public-read',
                    'Bucket' => 'bosstrainer1',
                    'Key'    => $file_name,
                    'SourceFile' => $temp_file_location
                ]);
                if($result['@metadata']['statusCode'] == 200)
                    $bannerImage =  isset($result['ObjectURL']) ? $result['ObjectURL'] : '';
            }
            $model->profile_img = $avatarImage;
            $model->banner_img = $bannerImage;
            $model->save();
            Yii::$app->session->setFlash('success', 'Los detalles se actualizaron correctamente.');
            return $this->redirect(['view', 'id' => Yii::$app->user->id]);
        }
        else
        {
            $gym = Gym::find()->where(['id' => Yii::$app->user->id])->one();
            $localidades = Localidades::find()->all();
            $localidadesData = ArrayHelper::map($localidades,'id','nombre_localidad');

            return $this->render('settings', [
                'model' => $gym,
                'localidadesData' => $localidadesData
            ]);
        }
    }


    /**
     * @return string
     */
    public function actionGetprovincia()
    {
        $zipcode = Yii::$app->request->post('zipcode');
        $provincias = Provincias::find()->where(['id' => (int)$zipcode])->all();
        return $this->renderPartial('load_provincia',
            ['provincias'=>$provincias]);
    }

    /**
     * @return string
     */
    public function actionGetlocalidades()
    {
        $provincia_id = Yii::$app->request->post('provincia_id');
        $localidades = Localidades::find()->where(['provincia_id' => $provincia_id])->all();
        return $this->renderPartial('load_localidades',
            ['localidades'=>$localidades]);
    }

    /**
     * @param $id
     * @return string
     */
    public function actionView($id)
    {
        $gym = Gym::find()->where(['id' => $id])->one();
        return $this->render('viewprofile', [
            'model' => $gym
        ]);
    }

    /**
     * Finds the User model based on its primary key value.
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
     * Finds the Rate model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param $user_id
     * @return Rate the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModelRate($user_id)
    {
        if (($model = Rate::findOne(['gym_id' => Yii::$app->user->identity->id, 'user_id' => $user_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * @return string
     */
    public function actionFollowers()
    {
        $searchModel = new GymUserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('followers', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider
        ]);
    }

    /**
     * @param $id
     * @return array|string|Response
     */
    public function actionAssignrate($id)
    {
        $model = new Rate();

        if ($model->load(Yii::$app->request->post())) {
            $model->start_date = date('Y-m-d H:i:s', strtotime(Yii::$app->request->post('Rate')['start_date']));
            $model->end_date = date('Y-m-d H:i:s', strtotime(Yii::$app->request->post('Rate')['end_date']));
            $model->save();
            return $this->redirect(['followers']);
        }
        return $this->render('assignrate', [
            'model' => $model,
            'id' => $id
        ]);
    }

    /**
     * Updates an existing Rate model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $rate_id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdaterate($user_id)
    {
        $model = $this->findModelRate($user_id);
        if(Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }

        if ($model->load(Yii::$app->request->post())) {
            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'Se ha actualizado con éxito su Tarifa.');
                return $this->redirect(['followers']);
            } else {
                Yii::$app->session->setFlash('error', 'Upss. Algo ha ocurrido mal.');
            }
        }

        if (Yii::$app->request->isAjax) {
            return $this->renderAjax('assignrate', [
                'model' => $model,
            ]);
        }else {
            return $this->render('assignrate', [
                'model' => $model,
                'id' => $user_id
            ]);
        }
    }

    /**
     * Deletes an existing Rate model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDeleterate()
    {
        $user_id = Yii::$app->request->post('rate_id');
        $model = Rate::findOne(['gym_id' => Yii::$app->user->identity->id, 'user_id' => $user_id]);
        if ( $model->delete() != false ) {
            Yii::$app->session->setFlash('success', 'Se ha borrado con éxito su Tarifa.');
            return $this->redirect(['site/followers']);
        } else {
            Yii::$app->session->setFlash('error', 'Upss. Algo ha ocurrido mal.');
            return $this->redirect(['site/followers']);
        }
    }
}
