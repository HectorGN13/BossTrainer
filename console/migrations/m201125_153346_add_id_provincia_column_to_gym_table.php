<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%gym}}`.
 */
class m201125_153346_add_id_provincia_column_to_gym_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%gym}}', 'id_provincia', $this->integer()->defaultValue(null));

        $this->createIndex(
            '{{%idx-gym-id_provincia}}',
            '{{%gym}}',
            'id_provincia'
        );

        // add foreign key for table `{{%gym}}`
        $this->addForeignKey(
            '{{%fk-gym-id_provincia}}',
            '{{%gym}}',
            'id_provincia',
            '{{%provincias}}',
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
            '{{%fk-gym-id_provincia}}',
            '{{%gym}}'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            '{{%idx-gym-id_provincia}}',
            '{{%user_gym}}'
        );


        $this->dropColumn('{{%gym}}', 'id_provincia');
    }
}
