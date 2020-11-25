<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%gym}}`.
 */
class m201125_164634_add_description_column_to_gym_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%gym}}', 'description', $this->string(320));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%gym}}', 'description');
    }
}
