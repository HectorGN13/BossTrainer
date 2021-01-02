<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%rate}}`.
 */
class m201231_042536_create_rate_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%rate}}', [
            'id' => $this->bigPrimaryKey(),
            'gym_id' => $this->integer()->notNull(),
            'user_id' => $this->integer()->notNull(),
            'title' => $this->string(255)->notNull(),
            'type' => $this->string(50)->notNull(),
            'price' => $this->string(50)->notNull(),
            'description' => $this->string()->notNull(),
            'start_date' => $this->datetime()->notNull(),
            'end_date' => $this->datetime()->notNull(),
        ]);

        // creates index for column `gym_id`
        $this->createIndex(
            '{{%idx-rate-gym_id}}',
            '{{%rate}}',
            'gym_id'
        );

        // add foreign key for table `{{%gym}}`
        $this->addForeignKey(
            '{{%fk-rate-gym_id}}',
            '{{%rate}}',
            'gym_id',
            '{{%gym}}',
            'id',
            'CASCADE'
        );

        // creates index for column `user_id`
        $this->createIndex(
            '{{%idx-rate-user_id}}',
            '{{%rate}}',
            'user_id'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-rate-user_id}}',
            '{{%rate}}',
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
        $this->dropForeignKey(
            '{{%fk-rate-gym_id}}',
            '{{%rate}}'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            '{{%idx-rate-gym_id}}',
            '{{%rate}}'
        );

        $this->dropForeignKey(
            '{{%fk-rate-user_id}}',
            '{{%rate}}'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            '{{%idx-rate-user_id}}',
            '{{%rate}}'
        );

        $this->dropTable('{{%rate}}');

    }
}
