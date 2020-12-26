<?php

use yii\db\Expression;
use yii\db\Migration;

/**
 * Handles the creation of table `{{%notification}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%user}}`
 */
class m201225_230807_create_notification_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%notification}}', [
            'id' => $this->primaryKey(),
            'recipient' => $this->integer()->notNull(),
            'title' => $this->string()->notNull(),
            'body' => $this->text()->notNull(),
            'read' => $this->integer()->notNull()->defaultValue(10),
            'created_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);

        // creates index for column `recipient`
        $this->createIndex(
            '{{%idx-notification-recipient}}',
            '{{%notification}}',
            'recipient'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-notification-recipient}}',
            '{{%notification}}',
            'recipient',
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
            '{{%fk-notification-recipient}}',
            '{{%notification}}'
        );

        // drops index for column `recipient`
        $this->dropIndex(
            '{{%idx-notification-recipient}}',
            '{{%notification}}'
        );

        $this->dropTable('{{%notification}}');
    }
}
