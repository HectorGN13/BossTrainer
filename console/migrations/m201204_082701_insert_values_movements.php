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
        Yii::$app->db->createCommand()->batchInsert($this->_movements, ['title', 'description', 'measure', 'video', 'img', 'type'], [

            ['Back Squat', 'La sentadilla trasera o back squat es un ejercicio funcional heredado de la halterofilia que ofrece múltipleas beneficios debido a la multitud de músculos que implica', 'Kg', 'https://www.youtube.com/watch?v=ultWZbUMPL8', '','rms'],
            ['Barbell Row', 'El barbell row es un ejercicio compuesto en el que se entrena todos los músculos principales de la espalda y asegura el grosor de la espalda', 'Kg', 'https://www.youtube.com/watch?v=I-qgwlP0J90', '','rms'],
            ['Bench Press', 'El press de banca o bench press es el ejercicio por excelencia de los gimnasios y uno de los ejercicios basicos junto al peso muerto y las sentadillas, en este ejerccio se trabaj la zona mayor y menor del pectoral, ademas de los tríceps y la porcion anterior del hombro.', 'Kg', 'https://www.youtube.com/watch?v=XSza8hVTlmM', '','rms'],
            ['Clean', 'El Clean, Power Clean o cargada, es un movimiento multiarticular, por lo que no sólo se focaliza en el trabajo de un músculo sino que involucra grandes grupos musculares. En este caso, se trabaja sobre todo los flexores de la cadera, isquiotibiales, cuádriceps, deltoides, trapecio y en menor medida, gemelos y lumbares.', 'Kg', 'https://www.youtube.com/watch?v=EKRiW9Yt3Ps', '','rms'],
            ['Clean & Jerk', 'Los dos tiempos o cargada y envión (en inglés clean and jerk), consiste en levantar la barra desde el suelo hasta los hombros con una sentadilla. Posteriormente se recupera en posición de pie, para iniciar la segunda fase realizando una flexión de las piernas empujando la barra por encima de la cabeza con una tijera al mismo tiempo.', 'Kg', 'https://www.youtube.com/watch?v=PjY1rH4_MOA', '','rms'],
            ['Dead Lift', 'El Deadlift es un ejercicio funcional para todo el cuerpo que trabaja desde las pantorrillas, los isquiotibiales, los cuádriceps y los glúteos hasta la espalda, dorsales, trapecio, bíceps y antebrazos. Hay muy pocos ejercicios que aporten tanto a la espalda en lo referente al aumento y crecimiento muscular.', 'Kg', 'https://www.youtube.com/watch?v=op9kVnSso6Q', '','rms'],
            ['Front Squat', 'La sentadilla frontal o front squat es uno de los movimientos básicos de CrossFit. Se trata de de un ejercicio funcional base, que te ayudará a trabajar la fuerza y potencia de tu tren inferior. Además, conocer la técnica del front squat te ayudará con otros movimientos más avanzados como el push press o el push jerk.', 'Kg', 'https://www.youtube.com/watch?v=m4ytaCJZpl0', '','rms'],
            ['Hang Squat Clean', 'El hang clean es una variación de arranque del clean que es popular entre los levantadores de pesas olímpicos, Puede funcionar para aumentar la tasa de desarrollo de la fuerza en la cadera, mejorar la técnica de arranque e incluso usarse para aumentar la explosividad en atletas de todos los niveles.', 'Kg', 'https://www.youtube.com/watch?v=TjTEOme9fvw', '','rms'],
            ['Hang Squat Snatch', 'El hang snatch es una variación de arranque del snatch que es popular entre los levantadores de pesas olímpicos. Puede funcionar para aumentar la tasa de desarrollo de la fuerza en la cadera, mejorar la técnica de arranque e incluso usarse para aumentar la explosividad en atletas de todos los niveles.', 'Kg', 'https://www.youtube.com/watch?v=oTlSsPZaewg', '','rms'],
            ['Overhead Squat', 'Este ejercicio es considerado por muchos un tesoro funcional, ya que supone la base para desarrollar correctamente el snatch y resulta una herramienta indispensable para mejorar velocidad y potencia. Además, mejora flexibilidad funcional y la técnica de la sentadilla.', 'Kg', 'https://www.youtube.com/watch?v=RD_vUnqwqqI', '','rms'],
            ['Pendlay Row', 'El pendlay row sigue siendo un tipo de barbell row, por lo que se enfoca en las mismas áreas, principalmente los dorsales, pero la mayoría de los músculos de la espalda superior e inferior también están incluidos en el movimiento. Es un levantamiento más exigente que el remo con barra estándar, debido al hecho de que tienes que levantar la barra del suelo cada vez.', 'Kg', 'https://www.youtube.com/watch?v=aBdVkCle1fU', '','rms'],
            ['Power Clean', 'El Power Clean, Clean o Cargada es uno de los mejores métodos para ganar fuerza y masa muscular dentro del universo del Crossfit y de otras rutinas de gimnasio. Se trata de un ejercicio de potencia en donde, con ayuda de todo el cuerpo, se eleva una barra desde el suelo hasta la parte anterior de los hombros.', 'Kg', 'https://www.youtube.com/watch?v=GVt4uQ0sDJE', '','rms'],
            ['Power Snatch', 'El power snatch o arrancadas de potencia es un ejercicio que se utiliza comúnmente en las rutinas de crossfit pero proviene de la halterofilia.Para realizarlo subimos la barra por encima de la cabeza manteniendo al cuerpo en posición de sentadilla para después levantar el cuerpo manteniendo la posición de la barra adoptada.', 'Kg', 'https://www.youtube.com/watch?v=tuOiNeTvLJs', '','rms'],
            ['Push Jerk', 'La manera estándar de realizar el push jerk se realiza con barra. El movimiento consiste en elevarla desde el torso hasta encima de la cabeza, ayudado de un empuje de cadera y recibir la barra en posición de media sentadilla, para terminar el ejercicio con una extensión de cadera con un overhead squat parcial.', 'Kg', 'https://www.youtube.com/watch?v=V-hKuAfWNUw', '','rms'],
            ['Push Press', 'La manera estándar de realizar el push press, heredada de la halterofilia, se ejecuta con barra (barbell push press). Consiste en elevar la barra desde el torso hasta encima de la cabeza, ayudado de un empuje de cadera.', 'Kg', 'https://www.youtube.com/watch?v=X6-DMh-t4nQ', '','rms'],
            ['Snatch', 'El Snatch es uno de los movimientos de halterofilia más usados en Crossfit, La barra se debe subir lo más alto posible hasta llevarla por encima de la cabeza con los brazos extendidos mientras simultáneamente se realiza una sentadilla. Finalmente se extienden las piernas para quedar de pie, con los brazos extendidos y la barra sobre la cabeza.', 'Kg', 'https://www.youtube.com/watch?v=9xQp2sldyts', '','rms'],
            ['Muscle Snatch', 'El muscle snatch es un ejercicio de destreza-transferencia. Es usado principalmente para crear capacidad y percepción posicional para el primer y segundo jalón del snatch. Ñas piernas no se flexionan una vez que el jalón es completado. En vez, se mantienen derechas a medida que la barra continua sobre la cabeza.', 'Kg', 'https://www.youtube.com/watch?v=bJYzOo1cNqY', '','rms'],
            ['Split Jerk', 'El Split jerk es el último movimiento en el clean en donde usamos la cadera para elevar la barra hasta nuestra nariz para luego meternos debajo de la barra.', 'Kg', 'https://www.youtube.com/watch?v=PsiO8lZTU2I', '','rms'],
            ['Shoulder Press', 'El shoulder press se inicia de pie, con la barra apoyada sobre los deltoides y los brazos separados poco más allá del ancho de los hombros. Desde allí, sin movilizar el tronco ni las piernas, iniciamos el empuje desde los hombros hacia arriba de la cabeza para culminar con la barra elevada y los brazos completamente extendidos.', 'Kg', 'https://www.youtube.com/watch?v=xe19t2_6yis', '','rms'],
            ['Annie WOD', '50-40-30-20-10 Reps For Time. Double-Unders. Sit-Ups.', 'Time', 'https://www.youtube.com/watch?v=8AlKjswNExg', '','benchmark'],
            ['Barbara WOD', '5 Rondas For Time. 20 Pull-Ups. 30 Push-Ups. 40 Sits-Ups. 50 Air Squats. 3 Min Rest.', 'Time', 'https://www.youtube.com/watch?v=uBfR2qclYFQ', '','benchmark'],
            ['Diane WOD', '21-15-9 Reps For Time. Deadlifts. Handstand Push-Ups.', 'Time', 'https://www.youtube.com/watch?v=30GJA3uyDQE', '','benchmark'],
            ['Elizabeth WOD', '21-15-9 Reps For Time. Squat Cleans. Ring Dips.', 'Time', 'https://www.youtube.com/watch?v=YX6tU36w4x4', '','benchmark'],
            ['Eva WOD', '5 Rondas For Time. 800 mts Run. 30 Kettlebell Swings. 30 Pull-Ups.', 'Time', 'https://www.youtube.com/watch?v=seqmps8gaTQ', '','benchmark'],
            ['Fran WOD', '21-15-9 Reps For Time. Thrusters (95/65 lb). Pull-Ups.', 'Time', 'https://www.youtube.com/watch?v=Xx0eB1W8P1w', '','benchmark'],
            ['Grace WOD', 'For Time. 30 Clean and Jerks (135/95 lbs).', 'Time', 'https://www.youtube.com/watch?v=IWHhThVqMhU', '','benchmark'],
            ['Helen WOD', '3 Rondas For Time. 400 mts Run. 21 Kettlebell Swings. 12 Pull-Ups.', 'Time', 'https://www.youtube.com/watch?v=H0ap3bv40Yo', '','benchmark'],
            ['Isabel WOD', 'For Time. 30 Snatches (135/95 lbs) .', 'Time', 'https://www.youtube.com/watch?v=26SFLW8K88k', '','benchmark'],
            ['Karen WOD', 'For Time. 150 Wall Ball Shots.', 'Time', 'https://www.youtube.com/watch?v=0RMov-IaJzQ', '','benchmark'],
            ['Linda WOD', '10-9-8-7-6-5-4-3-2-1 Reps For Time. Deadlift. Bench Press. Clean.', 'Time', 'https://www.youtube.com/watch?v=5suf1VvrDEY', '','benchmark'],
            ['Mary WOD', 'AMRAP. 5 Handstand Push-Ups. 10 Pistols (alternating legs). 15 Pull-Ups.', 'Time', 'https://www.youtube.com/watch?v=EDDQr4Vx7oo', '','benchmark'],
            ['Murph WOD', 'For time. 1 mille run (1600 mtrs). 100 Pull Ups. 200 Push Ups. 300 air squats. 1 mille run (1600 mtrs).', 'Time', 'https://www.youtube.com/watch?v=M_ry-0rLRoc', '','benchmark'],
            ['Nancy WOD', '5 Rondas For time. 400 mts Run. 15 Overhead Squats.', 'Time', 'https://www.youtube.com/watch?v=tbH5qVwyOTc', '','benchmark'],
            ['Nicole WOD', 'AMRAP. 400 mts Run. Max Pull-Ups.', 'Time', 'https://www.youtube.com/watch?v=tbH5qVwyOTc', '','benchmark'],
            ['Bar Muscle Ups', 'Este ejercicio englobado dentro de los de tipo gimnásticos aúna básicamente dos movimientos con algunas variantes, una dominada con agarre pronador y un fonde de triceps', 'Reps', 'https://www.youtube.com/watch?v=OCg3UXgzftc', '','ability'],
            ['Burpees', 'Los burpees son unos de los ejercicios más conocidos dentro del crossfit. Perfectos para principiantes, son eficaces para calentar y entrenar todo el cuerpo, mejorar tu rendimiento y, sobre todo, quemar calorías', 'Reps', 'https://www.youtube.com/watch?v=auBLPXO8Fww', '','ability'],
            ['Dips', 'La realización de fondos o dips requiere tanto de fuerza como de control muscular, se trata de un movimiento intenso, complejo pero muy efectivo para trabajar músculos del tren superior del cuerpo y desarrollar la fuerza en los mismos.', 'Reps', 'https://www.youtube.com/watch?v=o2qX3Zb5mvg', '','ability'],
            ['Double Under', 'Los double under son uno de los ejercicios del CrossFit, como los burpees, perfectos para calentar, perder peso y tonifcar el tren superior e inferior. La clave de los double under o saltos dobles a la comba es darle velocidad a la cuerda, el objetivo es pasar la comba un par de veces por debajo de tus pies en cada salto.', 'Reps', 'https://www.youtube.com/watch?v=82jNjDS19lg', '','ability'],
            ['Handstand Push Ups', 'Las Handstand Push Ups pertenecen al rango de ejercicios gimnásticos, son las conocidas como flexiones invertidas o flexiones pino, ideales para entrenar el tren superior.', 'Reps', 'https://www.youtube.com/watch?v=0wDEO6shVjc', '','ability'],
            ['Handstand', 'El Handstand o el pino es unos de los pilares de los ejercicios de calestenia. Se trabaja principalmente el equilibrio y el tren superior.', 'Reps', 'https://www.youtube.com/watch?v=_-9_46by2JI', '','ability'],
            ['Pull ups', 'Pull ups o dominadas es un ejercicio que implica gran trabajo muscular por parte de brazos y espalda, además de los músculos del abdomen que deben estar contraidos.', 'Reps', 'https://www.youtube.com/watch?v=HRV5YKKaeVw', '','ability'],
            ['Butterfly Pull ups', 'Dominadas mariposa variantes del ejercicio de dominadas en la que se realiza un movimiento de oscilación para generar intensidad al ejercicio.', 'Reps', 'https://www.youtube.com/watch?v=OenVG15QMj8', '','ability'],
            ['Spartan Push ups', 'Las Flexiones espartanas o Spartan Push Ups es un ejercicio que no requiere más para su realización que nuestro propio cuerpo, pues constituye una variante de las clásicas flexiones de brazos. Constituyen un ejercicio que se ejecuta de forma explosiva, permiten desarrollar fuerza y potencia al mismo tiempo que quemamos calorías.', 'Reps', 'https://www.youtube.com/watch?v=1OOnqZdw7PI', '','ability'],
            ['Push ups', 'Las Flexiones o Push Ups los Pushups trabajan principalmente los músculos grandes del pecho, así como los tríceps, además de músculos involucrados, que hacen que el Pushup sea un gran ejercicio corporal completo.', 'Reps', 'https://www.youtube.com/watch?v=0pkjOk0EiAk', '','ability'],
            ['Thrusters', 'El Thruster, es un movimiento compuesto realmente demoledor, combina dos ejercicios realmente duros, una sentadilla frontal con un press militar con barra', 'Reps', 'https://www.youtube.com/watch?v=0pkjOk0EiAk', '','ability'],
            ['100 mts', 'El ejercicio consiste en un sprint de 100 metros lisos ¿Cuánto tiempo tardas?', 'Time', 'https://www.youtube.com/watch?v=clhcm6tMCVI', '','mark'],
            ['1000 mts', 'El ejercicio consiste en una carrera de 1000 metros ¿Cuánto tiempo tardas?', 'Time', 'https://www.youtube.com/watch?v=7JyPg-utI14', '','mark'],
            ['5 Km', 'El ejercicio consiste en una carrera de 5000 metros ¿Cuánto tiempo tardas?', 'Time', 'https://www.youtube.com/watch?v=b01dG9v9LCY', '','mark'],
            ['Media Maratón', 'El medio maratón o la media maratón es una carrera a pie de larga distancia en ruta cuya distancia es de 21,097 metros, es decir, la mitad de la de un maratón. Este tipo de competición no se encuentra en el programa de los juegos olímpicos o en el Campeonato Mundial de Atletismo.', 'Time', 'https://www.youtube.com/watch?v=clhcm6tMCVI', '','mark'],
            ['Maratón', 'La maratón es una carrera de larga distancia que consiste en recorrer una distancia 42 km y 195 m. Su origen se encuentra en la gesta del soldado Filípides,que habría muerto tras haber corrido desde Atenas hasta Esparta para pedir refuerzos,lo que serían unos 213 kilómetros.', 'Time', 'https://www.youtube.com/watch?v=clhcm6tMCVI', '','mark'],

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
