<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%gym}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%board}}`
 */
class m201223_123047_add_default_board_column_to_gym_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%gym}}', 'default_board', $this->integer());

        // creates index for column `default_board`
        $this->createIndex(
            '{{%idx-gym-default_board}}',
            '{{%gym}}',
            'default_board'
        );

        // add foreign key for table `{{%board}}`
        $this->addForeignKey(
            '{{%fk-gym-default_board}}',
            '{{%gym}}',
            'default_board',
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
        // drops foreign key for table `{{%board}}`
        $this->dropForeignKey(
            '{{%fk-gym-default_board}}',
            '{{%gym}}'
        );

        // drops index for column `default_board`
        $this->dropIndex(
            '{{%idx-gym-default_board}}',
            '{{%gym}}'
        );

        $this->dropColumn('{{%gym}}', 'default_board');
    }
}
