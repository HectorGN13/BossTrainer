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
            [1,67,'2020-05-16'],
            [1,64,'2020-05-25'],
            [1,68,'2020-07-03'],
            [1,71,'2020-07-25'],
            [1,73,'2020-08-10'],
            [1,77,'2020-08-22'],
            [1,81,'2020-09-25'],
            [1,78,'2020-10-30'],
            [1,75,'2020-12-05'],
            [1,76,'2020-12-15'],
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
