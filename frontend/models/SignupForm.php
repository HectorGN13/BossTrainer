<?php
namespace frontend\models;

use kartik\password\StrengthValidator;
use phpDocumentor\Reflection\Types\Null_;
use Yii;
use yii\base\Model;
use common\models\User;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $username;
    public $email;
    public $password;
    public $passwordConfirm;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'filter', 'filter'=>'strtolower'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Este nombre de usuario ya existe.'],
            ['username', 'string', 'min' => 3, 'max' => 255],

            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'filter', 'filter'=>'strtolower'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'Este correo electronico ya existe.'],

            ['password', 'required'],

            [
                ['password'], StrengthValidator::className(),
                'min' => 8,
                'minError'=>'Has introducido {found} caracteres. El mínimo requerido es 8.',
                'upper' => 1,
                'upperError'=> 'Debes introducir al menos una mayúscula.',
                'digit' => 1,
                'digitError'=> 'Debes introducir al menos un dígito.',
                'userAttribute'=>'username',
                'hasUser' => true,
                'hasUserError'=> 'La contraseña no puede contener el nombre de usuario.',
                'preset' => null,
                'special' => 0,
            ],

            ['passwordConfirm', 'required'],
            ['passwordConfirm', 'compare', 'compareAttribute'=>'password', 'message'=>"Las contraseñas no coinciden." ],
        ];
    }

    /**
     * Signs user up.
     *
     * @return bool whether the creating new account was successful and email was sent
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        
        $user = new User();
        $user->username = mb_strtolower($this->username);
        $user->email = mb_strtolower($this->email);
        $user->setPassword($this->password);
        $user->generateAuthKey();
        $user->generateEmailVerificationToken();
        return $user->save() && $this->sendEmail($user);

    }

    /**
     * Sends confirmation email to user
     * @param User $user user model to with email should be send
     * @return bool whether the email was sent
     */
    protected function sendEmail($user)
    {
        return Yii::$app
            ->mailer
            ->compose(
                ['html' => 'emailVerify-html', 'text' => 'emailVerify-text'],
                ['user' => $user]
            )
            ->setFrom([Yii::$app->params['supportEmail'] =>  'Registro en ' . Yii::$app->name])
            ->setTo($this->email)
            ->setSubject('Confirmación de correo para ' . Yii::$app->name)
            ->send();
    }
}
