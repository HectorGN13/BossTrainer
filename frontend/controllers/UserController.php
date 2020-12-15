<?php

namespace frontend\controllers;

use app\models\ImagenForm;
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
     *
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


//    /**
//     * Updates an existing User model.
//     * If update is successful, the browser will be redirected to the 'view' page.
//     * @param integer $id
//     * @return mixed
//     * @throws NotFoundHttpException
//     */
//    public function actionUpdate($id)
//    {
////        $img = new ImagenForm();
////        $model = $this->findModel($id);
////        $previous_photo = $model->profile_img;
////        if (Yii::$app->request->isPost) {
////            if ($model->load(Yii::$app->request->post())) {
////                $upload = UploadedFile::getInstance($img, 'imagen');
////                if(is_object($upload)){
////                    $upload_filename = 'images/user/' . $upload->baseName . '.' . $upload->extension;
////                    $upload->saveAs($upload_filename);
////                    $model->profile_img = $upload_filename;
////                }else{
////                    $model->profile_img = $previous_photo;
////                }
////                if ($model->save()) {
////                    Yii::$app->session->setFlash('success', 'Su perfil se ha modificado correctamente.');
////                    return $this->redirect(['profile', 'id' => $model->id]);
////                } else {
////                    Yii::$app->session->setFlash('error', 'Error al modificar su perfil.');
////                }
////            }
////        }
////        return $this->render('update', [
////            'model' => $model,
////        ]);
//
//        $model = User::findOne($id);
//
//
//        if ($model->load(Yii::$app->request->post())){
//            $model->save();
//            Yii::$app->session->setFlash('success', 'Su perfil se ha modificado correctamente.');
//            return $this->redirect(['profile', 'id' => $model->id]);
//        }
//
//        return $this->render('update', [
//            'model' => $model,
//        ]);
//
//
//    }
//
//
//    public function actionUpload($id)
//    {
//        $model = new ImagenForm();
//        var_dump('Estes en subir imagen perfil');
//
//        if (Yii::$app->request->isPost) {
//            $model->imagen = UploadedFile::getInstance($model, 'imagen');
//            if ($model->subida($id) && $model->subidaAws($id)) {
//                Yii::$app->session->setFlash('success', 'Imagen subida con exito');
//                $model->borradoLocal($id);
//                return $this->redirect('usuarios/view');
//            }
//        }
//
//        return $this->render('imagen', [
//            'model' => $model,
//        ]);
//    }
//
//    /**
//     *
//     * @param $id
//     * @return string|Response
//     * @throws NotFoundHttpException
//     */
//    public function actionUpdatePhoto($id)
//    {
//        $model = $this->findModel($id);
//        $oldFile = $model->getImageFile();
//        $oldAvatar = $model->avatar;
//        $oldFileName = $model->filename;
//
//        if ($model->load(Yii::$app->request->post())) {
//            // process uploaded image file instance
//            $image = $model->uploadImage();
//
//            // revert back if no valid file instance uploaded
//            if ($image === false) {
//                $model->avatar = $oldAvatar;
//                $model->filename = $oldFileName;
//            }
//
//            if ($model->save()) {
//                // upload only if valid uploaded file instance found
//                if ($image !== false && unlink($oldFile)) { // delete old and overwrite
//                    $path = $model->getImageFile();
//                    $image->saveAs($path);
//                }
//                return $this->redirect(['view', 'id'=>$model->_id]);
//            } else {
//                // error in saving model
//            }
//        }
//        return $this->render('update', [
//            'model'=>$model,
//        ]);
//    }


    /**
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

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
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
}
