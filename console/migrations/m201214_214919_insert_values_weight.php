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
            [1,67, $time - (56 * 24 * 60 * 60) ],
            [1,64,$time - (49 * 24 * 60 * 60) ],
            [1,68, $time - (42 * 24 * 60 * 60) ],
            [1,71, $time - (35 * 24 * 60 * 60) ],
            [1,73, $time - (28 * 24 * 60 * 60) ],
            [1,77,$time - (21 * 24 * 60 * 60) ],
            [1,81, $time - (14 * 24 * 60 * 60) ],
            [1,78, $time - (7 * 24 * 60 * 60) ],
            [1,75,$time],

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
