<?php

use yii\db\Migration;
use yii\db\Query;

/**
 * Class m201214_214919_insert_values_weight
 */
class m201214_214919_insert_values_weight extends Migration
{
    private $_weight = "{{%weight}}";
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $time = time() - (7 * 24 * 60 * 60);
        Yii::$app->db->createCommand()->batchInsert($this->_weight, ['user_id', 'value', 'create_at' ], [
            [1,67,'16-05-2020'],
            [1,64,'25-05-2020'],
            [1,68,'03-07-2020'],
            [1,71,'25-07-2020'],
            [1,73,'10-08-2020'],
            [1,77,'22-08-2020'],
            [1,81,'25-09-2020'],
            [1,78,'30-10-2020'],
            [1,75,'05-12-2020'],
            [1,76,'15-12-2020'],
        ])->execute();

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        foreach ((new Query)->from('weight')->each() as $record) $this->delete( $this->_weight,['id' => $record['id']]);
    }

}
