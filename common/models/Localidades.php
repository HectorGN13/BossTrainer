<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "localidades".
 *
 * @property int $id
 * @property int $provincia_id
 * @property string $nombre_localidad
 *
 * @property Gym[] $gyms
 * @property Provincias $provincia
 */
class Localidades extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'localidades';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['provincia_id', 'nombre_localidad'], 'required'],
            [['provincia_id'], 'default', 'value' => null],
            [['provincia_id'], 'integer'],
            [['nombre_localidad'], 'string', 'max' => 50],
            [['provincia_id'], 'exist', 'skipOnError' => true, 'targetClass' => Provincias::className(), 'targetAttribute' => ['provincia_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'provincia_id' => 'Provincia ID',
            'nombre_localidad' => 'Nombre Localidad',
        ];
    }

    /**
     * Gets query for [[Gyms]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGyms()
    {
        return $this->hasMany(Gym::className(), ['localidad_id' => 'id'])->inverseOf('localidad');
    }

    /**
     * Gets query for [[Provincia]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProvincia()
    {
        return $this->hasOne(Provincias::className(), ['id' => 'provincia_id'])->inverseOf('localidades');
    }
}
