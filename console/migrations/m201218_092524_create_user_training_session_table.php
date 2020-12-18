<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user_training_session}}`.
 */
class m201218_092524_create_user_training_session_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user_training_session}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(),
            'training_session_id' => $this->integer()
        ]);

        // creates index for column `user_id`
        $this->createIndex(
            '{{%idx-user_training_session-user_id}}',
            '{{%user_training_session}}',
            'user_id'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-user_training_session-user_id}}',
            '{{%user_training_session}}',
            'user_id',
            '{{%user}}',
            'id',
            'CASCADE'
        );

        // creates index for column `training_session_id`
        $this->createIndex(
            '{{%idx-user_training_session_id}}',
            '{{%user_training_session}}',
            'training_session_id'
        );

        // add foreign key for table `{{%training_session}}`
        $this->addForeignKey(
            '{{%fk-user_training_session_id}}',
            '{{%user_training_session}}',
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
        // drops foreign key for table `{{%user_training_session}}`
        $this->dropForeignKey(
            '{{%fk-user_training_session-user_id}}',
            '{{%user_training_session}}'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            '{{%idx-user_training_session-user_id}}',
            '{{%user_training_session}}'
        );

        // drops foreign key for table `{{%gym}}`
        $this->dropForeignKey(
            '{{%fk-user_training_session-training_session_id}}',
            '{{%user_training_session}}'
        );

        // drops index for column `training_session_id`
        $this->dropIndex(
            '{{%idx-user_training_session-training_session_id}}',
            '{{%user_training_session}}'
        );

        $this->dropTable('{{%user_training_session}}');
    }
}
