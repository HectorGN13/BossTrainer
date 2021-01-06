# Dificultades encontradas

#### **Plantilla avanzada de Yii2**

A lo largo del proyecto he maldecido decenas de veces haber tomado esta decisión, aunque a día de hoy no me arrepiento ya que he aprendido mucho. 

Entre las dificultades que me he ido encontrando quizás la que más dolor de cabeza me dio, fue a la hora de desplegar en heroku. Debido a su propia naturaleza se necesita de varias configuraciones especificas tanto en apache como en el propio documento.

Pese a todo encontré un plugin que me sirvió de bastante ayuda a la hora de desplegar el proyecto. A medida que estoy escribiendo esto me vienen a la mente varios momentos de estrés, algunos a la hora de desplegar en local, y otros debido a la incopativilidad de ciertos paquetes de composer. 

Pero tengo que decir que con todo esto siempre encontré la solución en 'stackoverfload' o en algún foro ruso perdido de la mano de dios. 

#### **Hardcode**

Una de las dificultades que me encontré al inicio del proyecto, que me han ayudado a aprender debido a que fue por mi inexperiencia, se dió a la hora de Modificar códigos ajenos. 

En vez de crearme un nuevo modulo a partir de un código ya hecho, yo modificaba 'in situ' dicho código, obviamente me generaba numerosos problemas de incompativilidad a la hora de desplegar el proyecto. Pese a todo, esto me ha servido para hacer las cosas correctamente y aprender.   

#### **Errores JS y de sintaxis**

Otros problemas que me han ido retrasando a lo largo del proyecto han sido los conocidos como ``type errors`` no sabría explicar porque en mi entorno local este tipo de errores no solo pasaban desapercibidos sino que se corregían o el sistema los solucionaba, cosa que no pasaba en heroku que era más restrictivo. 

Debido a esto un simple error por haber escrito con minuscula por ejemplo el nombre de una clase se converian en un infierno que me hacía llevarme horas e incluso días revisando código para corregir dicho error.

---
# Elementos de innovación

* **Plantilla avanzada de Yii2**
* **Uso de VueJS**
* **Uso de AWS**

