<?php

use yii\db\Expression;
use yii\db\Migration;

/**
 * Class m201125_165042_insert_values_gym
 */
class m201125_165042_insert_values_gym extends Migration
{
    private $_gym = "{{%gym}}";

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $table = $this->_gym;
        $time = new Expression('NOW()');

        $this->insert( $table, [
            'name' => 'Boxeo Jerez',
            'address' => 'C/ jerezana 10',
            'email' => 'admin@boxeojerez.com',
            'auth_key' => Yii::$app->security->generateRandomString(),
            'password_hash' => Yii::$app->getSecurity()->generatePasswordHash('boxeojerez'),
            'password_reset_token' => Yii::$app->security->generateRandomString(),
            'created_at' => $time,
            'updated_at' => $time,
            'postal_code' => '11407',
            'id_provincia' => '11',
            'description' => 'Situados en pleno centro de la ciudad de Jerez "Boxeo Jerez" es uno de los mejores gimnasios 
            de alto rendimiento para deportistas de elíte y en especial para boxeadores. Tambien se dan clases para principiantes
            y amateurs. Además disponemos de 2 salas de spining y un cuadrilatero.'
        ]);

        $this->insert( $table, [
            'name' => 'Gym Toni',
            'address' => 'C/ ginebra 14',
            'email' => 'admin@gymtoni.com',
            'auth_key' => Yii::$app->security->generateRandomString(),
            'password_hash' => Yii::$app->getSecurity()->generatePasswordHash('gymtoni'),
            'password_reset_token' => Yii::$app->security->generateRandomString(),
            'created_at' => $time,
            'updated_at' => $time,
            'postal_code' => '11570',
            'id_provincia' => '11',
            'description' => 'Disfruta haciendo deporte sin preocupaciones, aqui desconectaras en el bar de nuestro gymnasio, 
            donde podrás tomarte unas cañas mientras tus hijos estan en clases de natación. Dispone de piscina climatizada
            saunas y mucho más. ¡Aquí te esperamos!'
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete( "{{%gym}}", ['email' => 'admin@boxeojerez.com']);
        $this->delete( "{{%gym}}", ['email' => 'admin@gymtoni.com']);
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m201125_165042_insert_values_gym cannot be reverted.\n";

        return false;
    }
    */
}
