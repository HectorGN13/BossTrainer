<?php

namespace frontend\controllers;

use common\models\Notification;
use Yii;
use common\models\User;
use common\models\UserSearch;
use yii\bootstrap4\ActiveForm;
use yii\filters\AccessControl;
use yii\helpers\FileHelper;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;
use yii\web\UploadedFile;


/**
 * Clase que implementa todas las acciones para el modelo User.
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
{

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['update', 'profile'],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function ($rules, $action) {
                            return Yii::$app->user->identity->id == Yii::$app->request->get('id');
                        },
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
     * Muestra el perfil del usuario.
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionProfile($id)
    {
        return $this->render('profile', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Muestra un listado de mis benchmarks del usuario actual.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionMyBenchmarks($id)
    {
        return $this->render('myBechmarks', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Modifica el modelo de User, además puede añadir foto a un Bucket de AWS
     * @param $id
     * @return array|string|Response
     * @throws NotFoundHttpException
     */
    public function actionUpdate($id)
    {

        $model = $this->findModel($id);
        if(Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }

        if ($model->load(Yii::$app->request->post())) {
            $avatarImage = Yii::$app->request->post('hidden_profile_img');
            if(isset($_FILES['User']) && !empty($_FILES['User']['name']['profile_img']))
            {
                $file = $_FILES['User'];
                $file_name = $file['name']['profile_img'];   
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
            $model->profile_img = $avatarImage;
            $model->save();
            Yii::$app->session->setFlash('success', 'Se ha modificado correctamente.');
            return $this->redirect(['profile', 'id' => $model->id]);
        }


        $model->oldPassword = '';
        $model->password = '';
        $model->passwordConfirm = '';

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }


    /**
     * Cuenta la cantidad de notificaciones no leidas.
     * @return false|string
     */
    public function actionNotify()
    {
        Yii::$app->response->format = yii\web\Response::FORMAT_JSON;
        $count = User::find()
            ->joinWith('notifications n')
            ->where(['user.id' => Yii::$app->user->id])
            ->andWhere(['n.read' => 10])
            ->count();


        return json_encode($count);
    }
}
