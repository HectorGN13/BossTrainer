<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%gym}}`.
 */
class m201125_162616_add_postal_code_column_to_gym_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%gym}}', 'postal_code', $this->integer(5)->defaultValue(null));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%gym}}', 'postal_code');
    }
}
