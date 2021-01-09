<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%type_rate}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%rate}}`
 */
class m201230_052105_create_type_rate_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%type_rate}}', [
            'id' => $this->primaryKey(),
            'title' => $this->string(30)->notNull()->unique(),
            'description' => $this->string()->notNull(),
            'gym_id' => $this->integer()->notNull(),
            'price' => $this->integer()->notNull(),
        ]);

        // creates index for column `gym_id`
        $this->createIndex(
            '{{%idx-type_rate-gym_id}}',
            '{{%type_rate}}',
            'gym_id'
        );

        // add foreign key for table `{{%rate}}`
        $this->addForeignKey(
            '{{%fk-type_rate-gym_id}}',
            '{{%type_rate}}',
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
        // drops foreign key for table `{{%rate}}`
        $this->dropForeignKey(
            '{{%fk-type_rate-gym_id}}',
            '{{%type_rate}}'
        );

        // drops index for column `rate_id`
        $this->dropIndex(
            '{{%idx-type_rate-gym_id}}',
            '{{%type_rate}}'
        );

        $this->dropTable('{{%type_rate}}');
    }
}
