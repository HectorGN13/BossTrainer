<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "provincias".
 *
 * @property int $id
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
            [['nombre_provincia'], 'string', 'max' => 30],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
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
        return $this->hasMany(Gym::className(), ['provincia_id' => 'id'])->inverseOf('provincia');
    }
}
