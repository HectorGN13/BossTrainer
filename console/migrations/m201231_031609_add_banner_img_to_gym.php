<?php

use yii\db\Migration;

/**
 * Class m201228_031609_add_banner_img_to_gym
 */
class m201231_031609_add_banner_img_to_gym extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('gym', 'banner_img', $this->string(200));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('gym', 'banner_img');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m201228_031609_add_banner_img_to_gym cannot be reverted.\n";

        return false;
    }
    */
}
