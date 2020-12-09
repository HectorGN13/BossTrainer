<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%user}}`.
 */
class m201209_153143_add_profile_img_column_name_column_about_column_to_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('user', 'profile_img', $this->string(200));
        $this->addColumn('user', 'name', $this->string(100));
        $this->addColumn('user', 'bio', $this->string(320));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('user', 'profile_img');
        $this->dropColumn('user', 'name');
        $this->dropColumn('user', 'bio');
    }
}
