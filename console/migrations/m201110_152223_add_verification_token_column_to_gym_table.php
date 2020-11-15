<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%gym}}`.
 */
class m201110_152223_add_verification_token_column_to_gym_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%gym}}', 'verification_token', $this->string()->defaultValue(null));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%gym}}', 'verification_token');
    }
}
