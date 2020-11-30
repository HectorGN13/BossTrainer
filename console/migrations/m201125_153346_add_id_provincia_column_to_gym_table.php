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
        $this->addColumn('{{%gym}}', 'provincia_id', $this->integer()->defaultValue(null));

        $this->createIndex(
            '{{%idx-gym-provincia_id}}',
            '{{%gym}}',
            'provincia_id'
        );

        // add foreign key for table `{{%gym}}`
        $this->addForeignKey(
            '{{%fk-gym-provincia_id}}',
            '{{%gym}}',
            'provincia_id',
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
            '{{%fk-gym-provincia_id}}',
            '{{%gym}}'
        );

        // drops index for column `provincias_id`
        $this->dropIndex(
            '{{%idx-gym-provincia_id}}',
            '{{%provincias}}'
        );


        $this->dropColumn('{{%gym}}', 'provincia_id');
    }
}
