<?php

use yii\db\Migration;

/**
 * Class m201218_142524_add_title_to_training_session
 */
class m201218_142524_add_title_to_training_session extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
         $this->addColumn('training_session', 'title', $this->string()->notNull());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('training_session', 'title');
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m201218_142524_add_title_to_training_session cannot be reverted.\n";

        return false;
    }
    */
}
