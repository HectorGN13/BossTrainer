<?php

use yii\db\Migration;
use yii\db\Expression;

/**
 * Class m201110_154221_insert_values_gym
 */
class m201110_154221_insert_values_gym extends Migration
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
            'name' => 'gym central box',
            'address' => 'C/ falsa 1',
            'email' => 'admin@centralbox.com',
            'auth_key' => Yii::$app->security->generateRandomString(),
            'password_hash' => Yii::$app->getSecurity()->generatePasswordHash('centralbox'),
            'password_reset_token' => Yii::$app->security->generateRandomString(),
            'created_at' => $time,
            'updated_at' => $time,
        ]);

        $this->insert( $table, [
            'name' => 'gym orbital',
            'address' => 'C/ verdadera 20',
            'email' => 'admin@orbital.com',
            'auth_key' => Yii::$app->security->generateRandomString(),
            'password_hash' => Yii::$app->getSecurity()->generatePasswordHash('orbital'),
            'password_reset_token' => Yii::$app->security->generateRandomString(),
            'created_at' => $time,
            'updated_at' => $time,
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->delete( "{{%gym}}", ['email' => 'admin@centralbox.com']);
        $this->delete( "{{%gym}}", ['email' => 'admin@orbital.com']);
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m201110_154221_insert_values_gym cannot be reverted.\n";

        return false;
    }
    */
}
