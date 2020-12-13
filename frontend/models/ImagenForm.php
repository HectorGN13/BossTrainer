<?php

namespace frontend\models;

use Yii;
use yii\base\Model;

/**
 * Clase encarga de subir la foto de perfil de un usuario.
 */
class ImagenForm extends Model
{
    public $imagen;

    public function rules()
    {
        return [
            [['imagen'], 'image', 'skipOnEmpty' => false, 'extensions' => ['png', 'jpg', 'jpeg', 'gif']],
        ];
    }

    public function uploadLocal($id)
    {
        if ($this->validate()) {
            $filename = $id . '.' . $this->imagen->extension;
            $origen = Yii::getAlias('@uploads/' . $filename);
            $destino = Yii::getAlias('@img/' . $filename);
            $this->imagen->saveAs($origen);

            rename($origen, $destino);
            return true;
        } else {
            return false;
        }
    }

    public function uploadAWS($id)
    {
        $filename = $id . '.' . $this->imagen->extension;
        $destino = Yii::getAlias('@img/' . $filename);
        $aws = Yii::$app->awssdk->getAwsSdk();
        $s3 = $aws->createS3();
        $amazon = $filename;
        $bucket = 'bosstrainer';
        $existe = $s3->doesObjectExist('bosstrainer', $amazon);
        if ($existe) :
            $s3->deleteObject([
                'Bucket'       => $bucket,
                'Key'          => $amazon,
            ]);
            $s3->putObject([
                'Bucket'       => $bucket,
                'Key'          => $amazon,
                'SourceFile'   => $destino,
                'ACL'          => 'public-read',
                'StorageClass' => 'REDUCED_REDUNDANCY',
                'Metadata'     => [
                    'param1' => 'value 1',
                    'param2' => 'value 2'
                ]
            ]);
        else :
            $s3->putObject([
                'Bucket'       => $bucket,
                'Key'          => $amazon,
                'SourceFile'   => $destino,
                'ACL'          => 'public-read',
                'StorageClass' => 'REDUCED_REDUNDANCY',
                'Metadata'     => [
                    'param1' => 'value 1',
                    'param2' => 'value 2'
                ]
            ]);
        endif;

        return true;
    }

    public function deleteLocal($id)
    {
        unlink(Yii::getAlias('@img/' . $id . '.' . $this->imagen->extension));
    }

}