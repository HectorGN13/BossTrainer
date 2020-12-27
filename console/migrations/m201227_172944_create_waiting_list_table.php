<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%waiting_list}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%user}}`
 * - `{{%training_session}}`
 */
class m201227_172944_create_waiting_list_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%waiting_list}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'training_session_id' => $this->integer()->notNull(),
        ]);

        // creates index for column `user_id`
        $this->createIndex(
            '{{%idx-waiting_list-user_id}}',
            '{{%waiting_list}}',
            'user_id'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-waiting_list-user_id}}',
            '{{%waiting_list}}',
            'user_id',
            '{{%user}}',
            'id',
            'CASCADE'
        );

        // creates index for column `training_session_id`
        $this->createIndex(
            '{{%idx-waiting_list-training_session_id}}',
            '{{%waiting_list}}',
            'training_session_id'
        );

        // add foreign key for table `{{%training_session}}`
        $this->addForeignKey(
            '{{%fk-waiting_list-training_session_id}}',
            '{{%waiting_list}}',
            'training_session_id',
            '{{%training_session}}',
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
            '{{%fk-waiting_list-user_id}}',
            '{{%waiting_list}}'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            '{{%idx-waiting_list-user_id}}',
            '{{%waiting_list}}'
        );

        // drops foreign key for table `{{%training_session}}`
        $this->dropForeignKey(
            '{{%fk-waiting_list-training_session_id}}',
            '{{%waiting_list}}'
        );

        // drops index for column `training_session_id`
        $this->dropIndex(
            '{{%idx-waiting_list-training_session_id}}',
            '{{%waiting_list}}'
        );

        $this->dropTable('{{%waiting_list}}');
    }
}
