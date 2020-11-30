<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%provincias}}`.
 */
class m201118_191200_create_provincias_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%provincias}}', [
            'id' => $this->primaryKey(),
            'nombre_provincia' => $this->string(30)->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%provincias}}');
    }
}
