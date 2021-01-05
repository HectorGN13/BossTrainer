<?php
namespace frontend\controllers;


use backend\models\Rate;
use common\models\Gym;
use common\models\Notification;
use frontend\models\ResendVerificationEmailForm;
use frontend\models\VerifyEmailForm;
use Yii;
use yii\base\InvalidArgumentException;
use yii\bootstrap4\ActiveForm;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use frontend\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use yii\web\Response;

/**
 * Controlador principal de site.
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
                'class' => AccessControl::class,
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
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
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Muestra el home o página principal del sitio.
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', [['Formulario enviado correctamente.','Muchas gracias por contactar con nosotros. Te responderemos lo antes posible.']]);
            } else {
                Yii::$app->session->setFlash('error',[['Error al enviar el formulario.', 'Lo sentimos, ha ocurrido un error al enviar tu mensaje.']]);
            }
            return $this->refresh();
        } else {
            return $this->render('index', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Acción para entrar en el sistema.
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            $userId = Yii::$app->user->id;
            $expiredRates = Rate::find()
                ->where(['user_id' => $userId])
                ->andWhere(['<', 'end_date', date('Y-m-d H:i:s')])
                ->all();

            $content = '';
            $gym = new Gym();
            $title = 'Tu tarifa ha terminado.';
            foreach($expiredRates as $rate)
            {
                $gymName = $gym->getGymName($rate->gym_id);
                $content .= 'Tu tarifa ha terminado en el gimnasio '.$gymName.', debe renovar su tarifa
                 para seguir disfrutando de los servicios de su gimnasio.';
            }
            $notification = new Notification;
            $notification->recipient = $userId;
            $notification->title = $title;
            $notification->body = $content;
            $notification->read = 10;
            $notification->created_at = date('Y-m-d H:i:s');
            $notification->save();
            return $this->goBack();
        } else {
            $model->password = '';

            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Acción para desconectar del sistema al usuario actual.
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Crear un nuevo modelo de usuario. Registrarse en el sistema.
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post()) && $model->signup()) {
            Yii::$app->session->setFlash('info',[
                ['Te has registrado correctamente.',
                'Muchas gracias por registrarte. 
                Hemos enviado a tu email un correo de verificación. 
                Este proceso puede tardar varios minutos, 
                si todavía no lo has recibido compruebe su bandeja de spam, 
                o utilice este enlace.']]);
            return $this->redirect('login');
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Petión de reinicio de pasword.
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if(Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Por favor, revise su correo electrónico para obtener más instrucciones.');
                return $this->redirect('login');
            } else {
                Yii::$app->session->setFlash('error', 'Lo sentimos, no podemos restablecer la contraseña de la dirección de correo proporcionada.');
            }
        }
        if (Yii::$app->request->isAjax) {
            return $this->renderAjax('requestPasswordResetToken', [
                'model' => $model,
            ]);
        } else {
            return $this->render('requestPasswordResetToken', [
                'model' => $model
            ]);
        }
    }

    /**
     * Vista para reiniciar password.
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', [
                ['Contraseña actualizada',
                    '¡Perfecto! Su contraseña se ha actualizado correctamente, ya puedes acceder al sistema.']]);

            return $this->redirect('login');
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    /**
     * Acción para verificar el correo electrónico.
     * Verify email address
     *
     * @param string $token
     * @throws BadRequestHttpException
     * @return yii\web\Response
     */
    public function actionVerifyEmail($token)
    {
        try {
            $model = new VerifyEmailForm($token);
        } catch (InvalidArgumentException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
        if ($user = $model->verifyEmail()) {
            if (Yii::$app->user->login($user)) {
                Yii::$app->session->setFlash('success',[
                    ['Correo verificado',
                        '¡Su correo se ha verificado correctamente!']]);
                return $this->redirect('login');
            }
        }

        Yii::$app->session->setFlash('error',[
            ['Error de verificación',
                'Lo sentimos pero no hemos podido verificar su correo.']]);
        return $this->redirect('login');
    }

    /**
     * Volver a enviar el correo de verificación.
     * Resend verification email
     *
     * @return mixed
     */
    public function actionResendVerificationEmail()
    {
        $model = new ResendVerificationEmailForm();
        if(Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Por favor, revise su correo electrónico para obtener más instrucciones.');
                return $this->redirect('login');
            }
            Yii::$app->session->setFlash('error', 'Lo sentimos, no podemos reenviar el correo electrónico de verificación para la dirección de correo electrónico proporcionada.');
            return $this->refresh();
        }
        if (Yii::$app->request->isAjax) {
            return $this->renderAjax('resendVerificationEmail', [
                'model' => $model
            ]);
        } else {
            return $this->render('resendVerificationEmail', [
                'model' => $model
            ]);
        }
    }
}
