<?php

namespace common\models;


use Yii;
use yii\base\NotSupportedException;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;
/**
 * This is the model class for table "gym".
 *
 * @property int $id
 * @property string $name
 * @property string $address
 * @property string $email
 * @property string $auth_key
 * @property string $password_hash
 * @property string|null $password_reset_token
 * @property int $status
 * @property string $created_at
 * @property string $updated_at
 * @property string|null $verification_token
 * @property string|null $profile_img
 * @property string|null $banner_img
 *
 * @property GymUser[] $GymUsers
 * @property User[] $users
 * @property Board[] $boards
 * @property Board $default_board
 * @property Localidades $localidad_id
 * @property Provincias $provincia_id
 */
class Gym extends \yii\db\ActiveRecord implements IdentityInterface
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
        return '{{%gym}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'address', 'email', 'auth_key', 'password_hash', 'created_at', 'updated_at'], 'required'],
            [['status', 'provincia_id', 'postal_code'], 'default', 'value' => null],
            [['status', 'provincia_id', 'postal_code'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'address', 'email', 'password_hash', 'password_reset_token', 'verification_token'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['description'], 'string', 'max' => 320],
            [['email'], 'unique'],
            [['profile_img', 'banner_img'], 'string', 'max' => 200],
            [['oldPassword'], 'findPasswords'],
            [['name'], 'unique'],
            [['password'], 'trim', 'on' => [self::SCENARIO_DEFAULT]],
            [['passwordConfirm'], 'compare', 'compareAttribute'=>'password', 'message'=>"Las contraseñas no coinciden.",
                'on' => [self::SCENARIO_DEFAULT, self::SCENARIO_UPDATE]],
            [['password_reset_token'], 'unique'],
            [['default_board'], 'exist', 'skipOnError' => true, 'targetClass' => Board::class, 'targetAttribute' => ['default_board' => 'id']],
            [['provincia_id'], 'exist', 'skipOnError' => true, 'targetClass' => Provincias::class, 'targetAttribute' => ['provincia_id' => 'id']],
            [['localidad_id'], 'exist', 'skipOnError' => true, 'targetClass' => localidades::class, 'targetAttribute' => ['localidad_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'address' => 'Address',
            'email' => 'Email',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Password Hash',
            'password_reset_token' => 'Password Reset Token',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'verification_token' => 'Verification Token',
            'provincia_id' => 'Provincia',
            'postal_code' => 'Código postal',
            'description' => 'Descripción',
            'localidad_id' => 'Localidad',
            'default_board' => 'Pizarra por defecto',
            'profile_img' => 'Profile Img',
            'banner_img' => 'Banner Img',
            'password' => 'Nueva contraseña',
            'passwordConfirm' => 'Confirmar contraseña',
            'oldPassword' => 'Contraseña actual'
        ];
    }

    /**
     * Gets query for [[UserGyms]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGymUsers()
    {
        return $this->hasMany(GymUser::class, ['gym_id' => 'id'])->inverseOf('gym');
    }

    /**
     * Gets query for [[Users]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::class, ['id' => 'user_id'])->viaTable('user_gym', ['gym_id' => 'id']);
    }

    /**
     * Gets query for [[Provincia]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProvincia()
    {
        return $this->hasOne(Provincias::class, ['id' => 'provincia_id'])->inverseOf('gyms');
    }

    /**
     * Gets query for [[Localidad]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLocalidad()
    {
        return $this->hasOne(Localidades::className(), ['id' => 'localidad_id'])->inverseOf('gyms');
    }


    /**
     * Gets query for [[Boards]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBoards()
    {
        return $this->hasMany(Board::className(), ['created_by' => 'id'])->inverseOf('createdBy');
    }

    /**
     * Gets query for [[DefaultBoard]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDefaultBoard()
    {
        return $this->hasOne(Board::className(), ['id' => 'default_board'])->inverseOf('gyms');
    }

    /**
     * @return bool
     */
    public function userFollowExist()
    {
        return $this->getGymUsers()->onCondition(['user_id' => Yii::$app->user->id])->exists();
    }
    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }
    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'status' => self::STATUS_ACTIVE]);
    }
    /**
     * Finds user by email
     *
     * @param string $email
     * @return static|null
     */
    public static function findByEmail($email)
    {
        return static::findOne(['email' => $email, 'status' => self::STATUS_ACTIVE]);
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
     * Matching the old password with your existing password.
     * @param $attribute
     * @param $params
     */
    public function findPasswords($attribute, $params)
    {
        if (!$this->validatePassword($this->oldPassword))
        {
            $this->addError($attribute,'Old password is incorrect');
        }
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
     * @param $gymId
     * @return array|ActiveRecord[]
     */
    public function getGymMembers($gymId)
    {
        return GymUser::find()
            ->joinWith('user')
            ->where(['gym_id' => $gymId])
            ->all();
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

    /**
     * @param $provinciaId
     * @return mixed|string|null
     */
    public function getProvinciaName($provinciaId)
    {
        $Provincias = Provincias::find()->where(['id' => $provinciaId])->one();
        return isset($Provincias->nombre_provincia) ? $Provincias->nombre_provincia : '';
    }

    /**
     * @param $localidadId
     * @return mixed|string|null
     */
    public function getLocalidadName($localidadId)
    {
        $localidades = Localidades::find()->where(['id' => $localidadId])->one();
        return isset($localidades->nombre_localidad) ? $localidades->nombre_localidad : '';
    }

    /**
     * @param $gymId
     * @return mixed|null
     */
    public function getGymName($gymId)
    {
        $gym = Gym::find()->where(['id' => $gymId])->one();
        return $gym->name;
    }
}
