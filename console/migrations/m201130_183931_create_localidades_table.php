<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%localidades}}`.
 */
class m201130_183931_create_localidades_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%localidades}}', [
            'id' => $this->primaryKey(),
            'provincia_id' => $this->integer()->notNull(),
            'nombre_localidad' => $this->string(50)->notNull(),
        ]);

        $this->createIndex(
            '{{%idx-localidades-provincia_id}}',
            '{{%localidades}}',
            'provincia_id'
        );

        // add foreign key for table `{{%gym}}`
        $this->addForeignKey(
            '{{%fk-localidades-provincia_id}}',
            '{{%localidades}}',
            'provincia_id',
            '{{%provincias}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            '{{%fk-localidades-provincia_id}}',
            '{{%localidades}}'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            '{{%idx-localidades-provincia_id}}',
            '{{%provincias}}'
        );

        $this->dropTable('{{%localidades}}');
    }
}
