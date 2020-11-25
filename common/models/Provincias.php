<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "provincias".
 *
 * @property int $id
 * @property int $cp_key
 * @property string $nombre_provincia
 *
 * @property Gym[] $gyms
 */
class Provincias extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'provincias';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cp_key', 'nombre_provincia'], 'required'],
            [['cp_key'], 'default', 'value' => null],
            [['cp_key'], 'integer'],
            [['nombre_provincia'], 'string', 'max' => 30],
            [['cp_key'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'cp_key' => 'Cp Key',
            'nombre_provincia' => 'Nombre Provincia',
        ];
    }

    /**
     * Gets query for [[Gyms]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGyms()
    {
        return $this->hasMany(Gym::className(), ['id_provincia' => 'id'])->inverseOf('provincia');
    }
}
