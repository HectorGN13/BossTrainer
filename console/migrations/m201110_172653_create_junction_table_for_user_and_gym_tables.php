<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user_gym}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%user}}`
 * - `{{%gym}}`
 */
class m201110_172653_create_junction_table_for_user_and_gym_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user_gym}}', [
            'user_id' => $this->integer(),
            'gym_id' => $this->integer(),
            'created_at' => $this->timestamp(),
            'PRIMARY KEY(user_id, gym_id)',
        ]);

        // creates index for column `user_id`
        $this->createIndex(
            '{{%idx-user_gym-user_id}}',
            '{{%user_gym}}',
            'user_id'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-user_gym-user_id}}',
            '{{%user_gym}}',
            'user_id',
            '{{%user}}',
            'id',
            'CASCADE'
        );

        // creates index for column `gym_id`
        $this->createIndex(
            '{{%idx-user_gym-gym_id}}',
            '{{%user_gym}}',
            'gym_id'
        );

        // add foreign key for table `{{%gym}}`
        $this->addForeignKey(
            '{{%fk-user_gym-gym_id}}',
            '{{%user_gym}}',
            'gym_id',
            '{{%gym}}',
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
            '{{%fk-user_gym-user_id}}',
            '{{%user_gym}}'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            '{{%idx-user_gym-user_id}}',
            '{{%user_gym}}'
        );

        // drops foreign key for table `{{%gym}}`
        $this->dropForeignKey(
            '{{%fk-user_gym-gym_id}}',
            '{{%user_gym}}'
        );

        // drops index for column `gym_id`
        $this->dropIndex(
            '{{%idx-user_gym-gym_id}}',
            '{{%user_gym}}'
        );

        $this->dropTable('{{%user_gym}}');
    }
}
