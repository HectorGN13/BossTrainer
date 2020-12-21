<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%board}}`.
 */
class m201216_165636_create_board_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%board}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string()->notNull(),
            'body' => $this->text()->notNull(),
            'created_by' => $this->bigInteger(),
        ]);

        // creates index for column `created_by`
        $this->createIndex(
            '{{%idx-board-created_by}}',
            '{{%board}}',
            'created_by'
        );

        // add foreign key for table `{{%gym}}`
        $this->addForeignKey(
            '{{%fk-board-created_by}}',
            '{{%board}}',
            'created_by',
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
        // drops foreign key for table `{{%gym}}`
        $this->dropForeignKey(
            '{{%fk-board-created_by}}',
            '{{%board}}'
        );

        // drops index for column `gym_id`
        $this->dropIndex(
            '{{%idx-board-created_by}}',
            '{{%board}}'
        );

        $this->dropTable('{{%board}}');
    }
}
