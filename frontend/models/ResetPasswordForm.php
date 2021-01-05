<?php
namespace frontend\models;

use kartik\password\StrengthValidator;
use yii\base\InvalidArgumentException;
use yii\base\Model;
use common\models\User;

/**
 * Formulario de reinicio de contraseña
 * Password reset form
 */
class ResetPasswordForm extends Model
{
    public $username;
    public $password;
    public $passwordConfirm;

    /**
     * @var \common\models\User
     */
    private $_user;


    /**
     * Crea un nuevo modelo de formulario de reinicio de contraseña según un token pasado por parámetro.
     * Creates a form model given a token.
     *
     * @param string $token
     * @param array $config name-value pairs that will be used to initialize the object properties
     * @throws InvalidArgumentException if token is empty or not valid
     */
    public function __construct($token, $config = [])
    {
        if (empty($token) || !is_string($token)) {
            throw new InvalidArgumentException('Password reset token cannot be blank.');
        }
        $this->_user = User::findByPasswordResetToken($token);
        if (!$this->_user) {
            throw new InvalidArgumentException('Wrong password reset token.');
        }
        parent::__construct($config);
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['password', 'required', 'message' => 'Debes introducir una contraseña.'],
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

            ['passwordConfirm', 'required', 'message' => 'Debes confirmar tu contraseña.'],
            ['passwordConfirm', 'compare', 'compareAttribute'=>'password', 'message'=>"Las contraseñas no coinciden." ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'password' => 'Contraseña',
            'passwordConfirm' => 'Confirmar contraseña'
        ];
    }

    /**
     * Reinicia la contraseña.
     * Resets password.
     *
     * @return bool if password was reset.
     */
    public function resetPassword()
    {
        if (!$this->validate()) {
            return null;
        }

        $user = $this->_user;
        $user->setPassword($this->password);
        $user->removePasswordResetToken();

        return $user->save(false);
    }
}
