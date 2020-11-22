<?php

use yii\db\Migration;


class m201107_095603_insert_values_user extends Migration
{
    private $_user = "{{%user}}";

    public function safeUp()
    {
        $password_hash = Yii::$app->getSecurity()->generatePasswordHash('Alba1234');
        $auth_key = Yii::$app->security->generateRandomString();
        $password_reset_token = Yii::$app->security->generateRandomString() ;
        $table = $this->_user;
        $time = time();

        $this->insert( $table, [
            'username' => 'hector',
            'auth_key' => $auth_key,
            'password_hash' => $password_hash,
            'password_reset_token' => $password_reset_token,
            'email' => 'hectoreduardo@iesdonana.org',
            'created_at' => $time,
            'updated_at' => $time,
        ]);
    }


    public function safeDown()
    {
        $this->delete( "{{%user}}", ['username' => 'hector']);
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m201107_095603_insert_values_user cannot be reverted.\n";

        return false;
    }
    */
}
