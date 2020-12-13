<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%record}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%user}}`
 * - `{{%movements}}`
 */
class m201212_182002_create_table_records extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%record}}', [
            'user_id' => $this->integer(),
            'movements_id' => $this->integer(),
            'PRIMARY KEY(user_id, movements_id)',
            'value' => $this->string(),
        ]);

        // creates index for column `user_id`
        $this->createIndex(
            '{{%idx-record-user_id}}',
            '{{%record}}',
            'user_id'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-user_id}}',
            '{{%record}}',
            'user_id',
            '{{%user}}',
            'id',
            'CASCADE'
        );

        // creates index for column `movements_id`
        $this->createIndex(
            '{{%idx-record-movements_id}}',
            '{{%record}}',
            'movements_id'
        );

        // add foreign key for table `{{%movements}}`
        $this->addForeignKey(
            '{{%fk-movements_id}}',
            '{{%record}}',
            'movements_id',
            '{{%movements}}',
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
            '{{%fk-user_id}}',
            '{{%record}}'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            '{{%idx-record-user_id}}',
            '{{%record}}'
        );

        // drops foreign key for table `{{%movements}}`
        $this->dropForeignKey(
            '{{%fk-movements_id}}',
            '{{%record}}'
        );

        // drops index for column `movements_id`
        $this->dropIndex(
            '{{%idx-record-movements_id}}',
            '{{%record}}'
        );

        $this->dropTable('{{%record}}');
    }
}
