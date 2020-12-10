<?php
namespace common\models;

use app\models\UserGym;
use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * User model
 *
 * @property integer $id
 * @property string $username
 * @property string $password_hash
 * @property string $password_reset_token
 * @property string $verification_token
 * @property string $email
 * @property string $auth_key
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $password write-only password
 * @property string $profile_img
 * @property string $name
 * @property string $bio
 */
class User extends ActiveRecord implements IdentityInterface
{
    const STATUS_DELETED = 0;
    const STATUS_INACTIVE = 9;
    const STATUS_ACTIVE = 10;

    const SCENARIO_UPDATE = 'update';

    public $passwordConfirm;
    public $password;
    public $oldPassword;



    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['email', 'required', 'message' => 'El correo electrónico no puede estar vacío'],
            ['email', 'email', 'message' => 'El formato no es válido, tienes que introducir un correo real.'],
            [['profile_img'], 'string', 'max' => 200],
            [['name'], 'string', 'max' => 100, 'message' => 'El nombre no puede superar los 100 caracteres.'],
            ['bio', 'string', 'max' => 320, 'message' => 'Tu biografía no puede superar los 320 caracteres.'],
            [['email'], 'trim'],
            [['username'], 'trim'],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'La direccion de correo ya está en uso.'],
            [['password_reset_token'], 'unique'],
            [['username'], 'unique'],

            [['oldPassword'], 'trim', 'on' => [self::SCENARIO_DEFAULT]],
            [['oldPassword'], function($attribute, $params, $validator) {
                if (!empty($this->$attribute) && !$this->validatePassword($this->$attribute)) {
                    $this->addError('oldPassword','Contraseña incorrecta');
                }
            }],
            
            [['password'], 'trim', 'on' => [self::SCENARIO_DEFAULT]],
            [['passwordConfirm'], 'compare', 'compareAttribute'=>'password', 'message'=>"Las contraseñas no coinciden.",
                'on' => [self::SCENARIO_DEFAULT, self::SCENARIO_UPDATE]],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Nombre de usuario.',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Password Hash',
            'password_reset_token' => 'Password Reset Token',
            'email' => 'Correo electrónico',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'verification_token' => 'Verification Token',
            'profile_img' => 'Profile Img',
            'name' => 'Nombre',
            'bio' => 'Mi biografía',
            'password' => 'Nueva contraseña',
            'passwordConfirm' => 'Confirmar contraseña',
            'oldPassword' => 'Contraseña actual'
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'status' => self::STATUS_ACTIVE]);
    }

    /**
     * Finds user by password reset token
     *
     * @param string $token password reset token
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token,
            'status' => self::STATUS_ACTIVE,
        ]);
    }

    /**
     * Finds user by verification email token
     *
     * @param string $token verify email token
     * @return static|null
     */
    public static function findByVerificationToken($token) {
        return static::findOne([
            'verification_token' => $token,
            'status' => self::STATUS_INACTIVE
        ]);
    }

    /**
     * Finds out if password reset token is valid
     *
     * @param string $token password reset token
     * @return bool
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }

        $timestamp = (int) substr($token, strrpos($token, '_') + 1);
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        return $timestamp + $expire >= time();
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Generates new token for email verification
     */
    public function generateEmailVerificationToken()
    {
        $this->verification_token = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }

    /**
     * Gets query for [[Gyms]].
     *
     * @return \yii\db\ActiveQuery
     * @throws \yii\base\InvalidConfigException
     */
    public function getGyms()
    {
        return $this->hasMany(Gym::className(), ['id' => 'gym_id'])->viaTable('user_gym', ['user_id' => 'id']);
    }

    /**
     * Gets query for [[UserGyms]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUserGyms()
    {
        return $this->hasMany(UserGym::className(), ['user_id' => 'id'])->inverseOf('user');
    }


    /**
     * @param bool $insert
     * @return bool
     * @throws \yii\base\Exception
     */
    public function beforeSave($insert)
    {
        if (!parent::beforeSave($insert)) {
            return false;
        }

        if(!$insert) {

            if ( $this->scenario === self::SCENARIO_DEFAULT) {
                if (empty($this->oldPassword) || is_null($this->oldPassword) ) {
                    $this->password = $this->getOldAttribute('password');
                } elseif (empty($this->password) || is_null($this->password)) {
                    $this->password = $this->getOldAttribute('password');
                }else {
                    if ($this->validatePassword($this->oldPassword)){
                        if ($this->password === null) {
                            $this->password = $this->getOldAttribute('password');
                        } else {
                            $this->password = $this->setPassword($this->password);
                        }
                    }
                }
            }
        }

        return true;
    }

}
