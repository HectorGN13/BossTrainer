<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%gym_board}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%gym}}`
 * - `{{%board}}`
 */
class m201216_170230_create_junction_table_for_gym_and_board_tables extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%gym_board}}', [
            'gym_id' => $this->integer(),
            'board_id' => $this->integer(),
            'PRIMARY KEY(gym_id, board_id)',
        ]);

        // creates index for column `gym_id`
        $this->createIndex(
            '{{%idx-gym_board-gym_id}}',
            '{{%gym_board}}',
            'gym_id'
        );

        // add foreign key for table `{{%gym}}`
        $this->addForeignKey(
            '{{%fk-gym_board-gym_id}}',
            '{{%gym_board}}',
            'gym_id',
            '{{%gym}}',
            'id',
            'CASCADE'
        );

        // creates index for column `board_id`
        $this->createIndex(
            '{{%idx-gym_board-board_id}}',
            '{{%gym_board}}',
            'board_id'
        );

        // add foreign key for table `{{%board}}`
        $this->addForeignKey(
            '{{%fk-gym_board-board_id}}',
            '{{%gym_board}}',
            'board_id',
            '{{%board}}',
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
            '{{%fk-gym_board-gym_id}}',
            '{{%gym_board}}'
        );

        // drops index for column `gym_id`
        $this->dropIndex(
            '{{%idx-gym_board-gym_id}}',
            '{{%gym_board}}'
        );

        // drops foreign key for table `{{%board}}`
        $this->dropForeignKey(
            '{{%fk-gym_board-board_id}}',
            '{{%gym_board}}'
        );

        // drops index for column `board_id`
        $this->dropIndex(
            '{{%idx-gym_board-board_id}}',
            '{{%gym_board}}'
        );

        $this->dropTable('{{%gym_board}}');
    }
}
