<?php

use yii\db\Migration;
use yii\db\Query;

/**
 * Class m201118_192052_insert_values_provincias
 */
class m201118_192052_insert_values_provincias extends Migration
{
    private $_provincias = "{{%provincias}}";
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        Yii::$app->db->createCommand()->batchInsert($this->_provincias, ['id', 'nombre_provincia'], [
            [2,'Albacete'],
            [3,'Alicante/Alacant'],
            [4,'Almería'],
            [1,'Araba/Álava'],
            [33,'Asturias'],
            [5,'Ávila'],
            [6,'Badajoz'],
            [7,'Balears, Illes'],
            [8,'Barcelona'],
            [48,'Bizkaia'],
            [9,'Burgos'],
            [10,'Cáceres'],
            [11,'Cádiz'],
            [39,'Cantabria'],
            [12,'Castellón/Castelló'],
            [51,'Ceuta'],
            [13,'Ciudad Real'],
            [14,'Córdoba'],
            [15,'Coruña, A'],
            [16,'Cuenca'],
            [20,'Gipuzkoa'],
            [17,'Girona'],
            [18,'Granada'],
            [19,'Guadalajara'],
            [21,'Huelva'],
            [22,'Huesca'],
            [23,'Jaén'],
            [24,'León'],
            [27,'Lugo'],
            [25,'Lleida'],
            [28,'Madrid'],
            [29,'Málaga'],
            [52,'Melilla'],
            [30,'Murcia'],
            [31,'Navarra'],
            [32,'Ourense'],
            [34,'Palencia'],
            [35,'Palmas, Las'],
            [36,'Pontevedra'],
            [26,'Rioja, La'],
            [37,'Salamanca'],
            [38,'Santa Cruz de Tenerife'],
            [40,'Segovia'],
            [41,'Sevilla'],
            [42,'Soria'],
            [43,'Tarragona'],
            [44,'Teruel'],
            [45,'Toledo'],
            [46,'Valencia/València'],
            [47,'Valladolid'],
            [49,'Zamora'],
            [50,'Zaragoza']
        ])->execute();
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        foreach ((new Query)->from('provincias')->each() as $provincia) $this->delete( $this->_provincias,['id' => $provincia['id'] ]);
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m201118_192052_insert_values_provincias cannot be reverted.\n";

        return false;
    }
    */
}
