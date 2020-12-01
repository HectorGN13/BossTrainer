<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%gym}}`.
 */
class m201201_173402_add_localidad_id_column_to_gym_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%gym}}', 'localidad_id', $this->integer()->defaultValue(null));

        $this->createIndex(
            '{{%idx-gym-localidad_id}}',
            '{{%gym}}',
            'localidad_id'
        );

        // add foreign key for table `{{%gym}}`
        $this->addForeignKey(
            '{{%fk-gym-localidad_id}}',
            '{{%gym}}',
            'localidad_id',
            '{{%localidades}}',
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
            '{{%fk-gym-localidad_id}}',
            '{{%gym}}'
        );

        // drops index for column `localidad_id`
        $this->dropIndex(
            '{{%idx-gym-localidad_id}}',
            '{{%gym}}'
        );


        $this->dropColumn('{{%gym}}', 'localidad_id');
    }
}
