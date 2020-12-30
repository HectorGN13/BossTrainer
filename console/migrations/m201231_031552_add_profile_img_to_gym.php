<?php

use yii\db\Migration;

/**
 * Class m201228_031552_add_profile_img_to_gym
 */
class m201231_031552_add_profile_img_to_gym extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('gym', 'profile_img', $this->string(200));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('gym', 'profile_img');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m201228_031552_add_profile_img_to_gym cannot be reverted.\n";

        return false;
    }
    */
}
