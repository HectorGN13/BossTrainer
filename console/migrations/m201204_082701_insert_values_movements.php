<?php

use yii\db\Migration;
use yii\db\Query;

/**
 * Class m201204_082701_insert_values_movements
 */
class m201204_082701_insert_values_movements extends Migration
{
    private $_movements = "{{%movements}}";

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        Yii::$app->db->createCommand()->batchInsert($this->_movements, ['title', 'description', 'measure', 'video', 'img'], [

            ['Back Squat', 'La sentadilla trasera o back squat es un ejercicio funcional heredado de la halterofilia que ofrece múltipleas beneficios debido a la multitud de músculos que implica', 'Kg', 'https://www.youtube.com/watch?v=ultWZbUMPL8', ''],
            ['Barbell Row', 'El barbell row es un ejercicio compuesto en el que se entrena todos los músculos principales de la espalda y asegura el grosor de la espalda', 'Kg', 'https://www.youtube.com/watch?v=I-qgwlP0J90', ''],
            ['Bench Press', 'El press de banca o bench press es el ejercicio por excelencia de los gimnasios y uno de los ejercicios basicos junto al peso muerto y las sentadillas, en este ejerccio se trabaj la zona mayor y menor del pectoral, ademas de los tríceps y la porcion anterior del hombro.', 'Kg', 'https://www.youtube.com/watch?v=XSza8hVTlmM', ''],
            ['Clean', 'El Clean, Power Clean o cargada, es un movimiento multiarticular, por lo que no sólo se focaliza en el trabajo de un músculo sino que involucra grandes grupos musculares. En este caso, se trabaja sobre todo los flexores de la cadera, isquiotibiales, cuádriceps, deltoides, trapecio y en menor medida, gemelos y lumbares.', 'Kg', 'https://www.youtube.com/watch?v=EKRiW9Yt3Ps', ''],
            ['Clean & Jerk', 'Los dos tiempos o cargada y envión (en inglés clean and jerk), consiste en levantar la barra desde el suelo hasta los hombros con una sentadilla. Posteriormente se recupera en posición de pie, para iniciar la segunda fase realizando una flexión de las piernas empujando la barra por encima de la cabeza con una tijera al mismo tiempo.', 'Kg', 'https://www.youtube.com/watch?v=PjY1rH4_MOA', ''],
            ['Dead Lift', 'El Deadlift es un ejercicio funcional para todo el cuerpo que trabaja desde las pantorrillas, los isquiotibiales, los cuádriceps y los glúteos hasta la espalda, dorsales, trapecio, bíceps y antebrazos. Hay muy pocos ejercicios que aporten tanto a la espalda en lo referente al aumento y crecimiento muscular.', 'Kg', 'https://www.youtube.com/watch?v=op9kVnSso6Q', ''],
            ['Front Squat', 'La sentadilla frontal o front squat es uno de los movimientos básicos de CrossFit. Se trata de de un ejercicio funcional base, que te ayudará a trabajar la fuerza y potencia de tu tren inferior. Además, conocer la técnica del front squat te ayudará con otros movimientos más avanzados como el push press o el push jerk.', 'Kg', 'https://www.youtube.com/watch?v=m4ytaCJZpl0', ''],
            ['Hang Squat Clean', 'El hang clean es una variación de arranque del clean que es popular entre los levantadores de pesas olímpicos, Puede funcionar para aumentar la tasa de desarrollo de la fuerza en la cadera, mejorar la técnica de arranque e incluso usarse para aumentar la explosividad en atletas de todos los niveles.', 'Kg', 'https://www.youtube.com/watch?v=TjTEOme9fvw', ''],
            ['Hang Squat Snatch', 'El hang snatch es una variación de arranque del snatch que es popular entre los levantadores de pesas olímpicos. Puede funcionar para aumentar la tasa de desarrollo de la fuerza en la cadera, mejorar la técnica de arranque e incluso usarse para aumentar la explosividad en atletas de todos los niveles.', 'Kg', 'https://www.youtube.com/watch?v=oTlSsPZaewg', ''],
            ['Overhead Squat', 'Este ejercicio es considerado por muchos un tesoro funcional, ya que supone la base para desarrollar correctamente el snatch y resulta una herramienta indispensable para mejorar velocidad y potencia. Además, mejora flexibilidad funcional y la técnica de la sentadilla.', 'Kg', 'https://www.youtube.com/watch?v=RD_vUnqwqqI', ''],
            ['Pendlay Row', 'El pendlay row sigue siendo un tipo de barbell row, por lo que se enfoca en las mismas áreas, principalmente los dorsales, pero la mayoría de los músculos de la espalda superior e inferior también están incluidos en el movimiento. Es un levantamiento más exigente que el remo con barra estándar, debido al hecho de que tienes que levantar la barra del suelo cada vez.', 'Kg', 'https://www.youtube.com/watch?v=aBdVkCle1fU', ''],
            ['Power Clean', 'El Power Clean, Clean o Cargada es uno de los mejores métodos para ganar fuerza y masa muscular dentro del universo del Crossfit y de otras rutinas de gimnasio. Se trata de un ejercicio de potencia en donde, con ayuda de todo el cuerpo, se eleva una barra desde el suelo hasta la parte anterior de los hombros.', 'Kg', 'https://www.youtube.com/watch?v=GVt4uQ0sDJE', ''],
            ['Power Snatch', 'El power snatch o arrancadas de potencia es un ejercicio que se utiliza comúnmente en las rutinas de crossfit pero proviene de la halterofilia.Para realizarlo subimos la barra por encima de la cabeza manteniendo al cuerpo en posición de sentadilla para después levantar el cuerpo manteniendo la posición de la barra adoptada.', 'Kg', 'https://www.youtube.com/watch?v=tuOiNeTvLJs', ''],
            ['Push Jerk', 'La manera estándar de realizar el push jerk se realiza con barra. El movimiento consiste en elevarla desde el torso hasta encima de la cabeza, ayudado de un empuje de cadera y recibir la barra en posición de media sentadilla, para terminar el ejercicio con una extensión de cadera con un overhead squat parcial.', 'Kg', 'https://www.youtube.com/watch?v=V-hKuAfWNUw', ''],
            ['Push Press', 'La manera estándar de realizar el push press, heredada de la halterofilia, se ejecuta con barra (barbell push press). Consiste en elevar la barra desde el torso hasta encima de la cabeza, ayudado de un empuje de cadera.', 'Kg', 'https://www.youtube.com/watch?v=X6-DMh-t4nQ', ''],
            ['Snatch', 'El Snatch es uno de los movimientos de halterofilia más usados en Crossfit, La barra se debe subir lo más alto posible hasta llevarla por encima de la cabeza con los brazos extendidos mientras simultáneamente se realiza una sentadilla. Finalmente se extienden las piernas para quedar de pie, con los brazos extendidos y la barra sobre la cabeza.', 'Kg', 'https://www.youtube.com/watch?v=9xQp2sldyts', ''],
            ['Muscle Snatch', 'El muscle snatch es un ejercicio de destreza-transferencia. Es usado principalmente para crear capacidad y percepción posicional para el primer y segundo jalón del snatch. Ñas piernas no se flexionan una vez que el jalón es completado. En vez, se mantienen derechas a medida que la barra continua sobre la cabeza.', 'Kg', 'https://www.youtube.com/watch?v=bJYzOo1cNqY', ''],
            ['Split Jerk', 'El Split jerk es el último movimiento en el clean en donde usamos la cadera para elevar la barra hasta nuestra nariz para luego meternos debajo de la barra.', 'Kg', 'https://www.youtube.com/watch?v=PsiO8lZTU2I', ''],
            ['Shoulder Press', 'El shoulder press se inicia de pie, con la barra apoyada sobre los deltoides y los brazos separados poco más allá del ancho de los hombros. Desde allí, sin movilizar el tronco ni las piernas, iniciamos el empuje desde los hombros hacia arriba de la cabeza para culminar con la barra elevada y los brazos completamente extendidos.', 'Kg', 'https://www.youtube.com/watch?v=xe19t2_6yis', ''],


        ])->execute();
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        foreach ((new Query)->from('movements')->each() as $movement) $this->delete( $this->_movements,['id' => $movement['id']]);
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m201204_082701_insert_values_movements cannot be reverted.\n";

        return false;
    }
    */
}
