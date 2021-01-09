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
            'user_id' => $this->integer()->notNull(),
            'type' => $this->integer()->notNull(),
            'start_date' => $this->datetime()->notNull(),
            'end_date' => $this->datetime()->notNull(),
        ]);


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

        // creates index for column `type`
        $this->createIndex(
            '{{%idx-rate-type}}',
            '{{%rate}}',
            'type'
        );

        // add foreign key for table `{{%type_rate}}`
        $this->addForeignKey(
            '{{%fk-rate-type_rate}}',
            '{{%rate}}',
            'type',
            '{{%type_rate}}',
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
            '{{%fk-rate-user_id}}',
            '{{%rate}}'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            '{{%idx-rate-user_id}}',
            '{{%rate}}'
        );

        $this->dropForeignKey(
            '{{%fk-rate-type_rate}}',
            '{{%rate}}'
        );

        // drops index for column `type`
        $this->dropIndex(
            '{{%idx-rate-type}}',
            '{{%rate}}'
        );

        $this->dropTable('{{%rate}}');

    }
}
