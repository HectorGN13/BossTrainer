<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%training_session}}`.
 */
class m201217_125128_create_training_session_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%training_session}}', [
            'id' => $this->primaryKey(),
            'description' =>$this->text()->notNull(),
            'start_time' => $this->datetime()->notNull(),
            'end_time' => $this->datetime()->notNull(),
            'capacity' => $this->integer(),
            'created_by' => $this->integer(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%training_session}}');
    }
}
