<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%user_training_session}}`.
 */
class m201230_052423_add_rating_column_to_user_training_session_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%user_training_session}}', 'rating', $this->smallInteger());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%user_training_session}}', 'rating');
    }
}
