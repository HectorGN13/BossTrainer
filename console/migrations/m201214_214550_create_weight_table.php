<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%weight}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%user}}`
 */
class m201214_214550_create_weight_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%weight}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'value' => $this->smallInteger()->notNull(),
            'create_at' => $this->date()->notNull(),
        ]);

        // creates index for column `user_id`
        $this->createIndex(
            '{{%idx-weight-user_id}}',
            '{{%weight}}',
            'user_id'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-weight-user_id}}',
            '{{%weight}}',
            'user_id',
            '{{%user}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%user}}`
        $this->dropForeignKey(
            '{{%fk-weight-user_id}}',
            '{{%weight}}'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            '{{%idx-weight-user_id}}',
            '{{%weight}}'
        );

        $this->dropTable('{{%weight}}');
    }
}
