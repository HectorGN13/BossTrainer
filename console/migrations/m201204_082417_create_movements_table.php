<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%movements}}`.
 */
class m201204_082417_create_movements_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%movements}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(60)->notNull()->unique(),
            'description' => $this->string(400)->notNull(),
            'measure' => $this->string(12)->notNull(),
            'video' => $this->string(),
            'img' => $this->string(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%movements}}');
    }
}
