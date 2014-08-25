<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Spanish language strings for the qcreate module
 *
 * @package    mod_qcreate
 * @license    http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or late
 */

$string['activitygrade'] = 'Ha recibido una calificación total de {$a->grade} / {$a->outof} por esta actividad.';
$string['addminimumquestionshdr'] = 'Nº mínimo de preguntas a calificar del Tipo :';
$string['allowall'] = 'Permitir todos los tipos de preguntas';
$string['allandother'] = 'Para permitir todos los tipos de preguntas, marque \'{$a}\' y nada más.';
$string['allquestions'] = '0 - (Todas las preguntas)';
$string['allowedqtypes'] = 'Tipos de preguntas requeridos';
$string['alreadydone'] = 'Ha introducido {$a} preguntas de este tipo.';
$string['alreadydoneextra'] = 'Ha introducido {$a} preguntas extra de este tipo.';
$string['alreadydoneextraone'] = 'Ha introducido una pregunta extra de este tipo.';
$string['alreadydoneone'] = 'Ha introducido una pregunta de este tipo.';
$string['and'] = '{$a} y';
$string['automaticgrade'] = 'Ha recibido una calificación automática de {$a->grade} / {$a->outof} por estas preguntas, ya que ha introducido {$a->done} de {$a->required} preguntas requeridas.';
$string['betterthangrade'] = 'Preguntas con calificación igual o mayor que';
$string['clickhere'] = 'Pinche aquí para crear una pregunta del tipo \'{$a}\'.';
$string['clickhereanother'] = 'Pinche aquí para crear otra pregunta del tipo \'{$a}\'.';
$string['close'] = 'Cerrar la actividad';
$string['comma'] = '{$a},';
$string['comment'] = 'Comentario';
$string['creating'] = 'Creando Preguntas';
$string['donequestionno'] = 'Ha completado {$a->done} de {$a->no} preguntas del tipo  \'{$a->qtypestring}\'. Se listan debajo.';
$string['exportgood'] = 'Exportar válidas';
$string['exportgoodquestions'] = 'Exportar las preguntas con calificación mayor que un valor dado';
$string['exportselection'] = 'Exportar sólo estas preguntas';
$string['extraqdone'] = 'Ha introducido una pregunta extra.';
$string['extraqsdone'] = 'Ha introducido {$a->extraquestionsdone} preguntas extra.';
$string['extraqgraded'] = 'Una pregunta de estos tipos será evaluada';
$string['extraqsgraded'] = '{$a->extrarequired} preguntas de estos tipos será evaluada';
$string['fullstop'] = '{$a}.';
$string['gradeallautomatic'] = 'Calificaciones completamente automáticas. No hay calificación manual.';
$string['gradeallmanual'] = 'Calificaciones completamente manuales. No hay calificación automática.';
$string['grademixed'] = 'Calificaciones  {$a->automatic}%% automáticas, {$a->manual}%% manual.';
$string['graded'] = 'Calificado';
$string['gradequestions'] = 'Califique las preguntas';
$string['grading'] = 'Calificar';
$string['graderatio'] = 'Ratio de calificación Automática / Manual';
$string['graderatiooptions'] = '{$a->automatic} / {$a->manual}';
$string['intro'] = 'Introducción';
$string['manualgrade'] = 'Un profesor ha otrogado una calificación de of {$a->grade} / {$a->outof} por las preguntas introducidas.';
$string['marked'] = 'Evaluado';
$string['minimumquestions'] = 'Preguntas mínimas';
$string['modulename'] = 'Crear preguntas';
$string['modulenameplural'] = 'Actividades Crear preguntas';
$string['needtoallowqtype'] = 'Debe permitir el tipo de pregunta \'{$a}\' si desea requerir la creación de un número mínimo de preguntas de este tipo.';
$string['needtoallowatleastoneqtype'] = 'Necesita permitir al menos un tipo de pregunta';
$string['needsgrading'] = 'Necesita calificación';
$string['needsregrading'] = 'necesita re-calificación';
$string['noofquestionstotal'] = 'Total de preguntas requeridas';
$string['notgraded'] = 'Aún no calificada';
$string['nousers'] = 'No hay usuarios matriculados en este curso o grupo.';
$string['open'] = 'Abrir la actividad';
$string['openmustbemorethanclose'] = 'El momento de abrir la actividad debe ser anterior en el tiempo al de cierre';
$string['overview'] = 'Presentación';
$string['pagesize'] = 'Número de preguntas a mostrar por página';
$string['qcreate'] = 'qcreate';
$string['qsgraded'] = '{$a} pregunta(s) de cualquiera de estos tipos será evaluada:';
$string['qtype'] = 'Tipo de Pregunta';
$string['requiredquestions'] = 'Preguntas a crear requeridas';
$string['requiredanyplural'] = 'Se requieren {$a->no} preguntas de cualquier tipo';
$string['requiredanysingular'] = 'Se requiere una pregunta de cualquier tipo';
$string['requiredplural'] = 'Se requieren  {$a->no} preguntas del tipo  \'{$a->qtypestring}\' ';
$string['requiredsingular'] = 'Se requiere una pregunta del tipo \'{$a->qtypestring}\' ';
$string['saveallfeedback'] = 'Guardar comentarios';
$string['saveallfeedbackandgrades'] = 'Guardar calificaciones y comentarios';
$string['selectone'] = 'Escoja uno ...';
$string['show'] = 'Mostrar ';
$string['showgraded'] = 'preguntas que no requieren evaluación';
$string['showneedsregrade'] = 'preguntas que requieren re-evaluación';
$string['showungraded'] = 'preguntas que requieren evaluación';
$string['studentqaccess'] = 'Con las preguntas propias';
$string['studentaccessheader'] = 'Accesoa las preguntas por estudiantes';
$string['studentaccessaddonly'] = 'Sólo crear';
$string['studentaccesspreview'] = 'Previsualizar';
$string['studentaccesssaveasnew'] = 'Previsualizar / Guardar como nueva';
$string['studentaccessedit'] = 'Previsualizar / Guardar como nueva / Editar / Borrar';
$string['timenolimit'] = 'No hay límite de tiempo definido.';
$string['timeopen'] = 'La actividad comienza en {$a->timeopen}';
$string['timeclose'] = 'La actividad termina en {$a->timeclose}';
$string['timeopenclose'] = 'La actividad está abierta desde el {$a->timeopen} al {$a->timeclose}';
$string['timing'] = 'Temporalización de la actividad';
$string['todoquestionno'] = 'Todavía debe introducir {$a->stillrequiredno} preguntas(s) del tipo \'{$a->qtypestring}\'.';
$string['totalgrade'] = 'Calificación total';
$string['totalgradeis'] = 'Calificación total: {$a}';
$string['totalrequiredislessthansumoftotalsforeachqtype'] = 'El total requerido es menor que la suma de los mínimos especificados para cada tipo de pregunta requerid.<br />¡Debe ser igual o mayor!';
$string['youvesetmorethanonemin'] = 'Ha especificado más de un mímimo de cuestiones de tipo \'{$a}\'!';
$string['open_help'] = '<h1>Abrir y Cerrar la actividad de Creación de Preguntas</h1>
<p>Puede especificar el día y la hora en la que los estudiantes pueden empezar a introducir texto para generar preguntas. <br />
Igualmente, el momento en el que la actividad terminará</p>
<p>Antes del momento de apertura, o después del cierre, la actividad de creación de preguntas no estará disponible.
Se podrá revisar lo existentes pero NO generar contenido nuevo.</p>';

$string['close_help'] = $string['open_help'];

$string['grade'] = get_string('grade');
$string['grade_help'] = '<h1>Calificación</h1>
<p>Esta es la Calificación total que se transladará al libro de notas. Es posible especificar "Sin calificación",
de forma que la actividad no será evaluable. </p>';

ob_start();
?>
<h1>Ratio calidicación Automática / Manual</h1>

<p>Aquí s edebe especificar cómo se calculará la puntuación total: el porcentaje de puntuación Automática es el primero
(izquierda), el de la calificación Manual es el segundo (derecha).</p>

<p>La Puntuación Automática es la nota otorgada por el sistema por simplemente introducir una pregunta.
Depende del número de preguntas realizadas sobre el total requerido. Así, por ejemplo, si requiere que se generen
10 preguntas y especifica un 100% de puntuación automática, un estudiante que crea 7  preguntas recibirá
el 70% de la nota máxima. Por otra parte, si especifica un 50% de puntuación Automática, un estudiante realize las
7 preguntas obtendrá automáticamente el 35% de la nota máxima (7/10 x 50% = 35%).</p>

<p>Obviamente, la nota automática no contieen ninguan garantía de calidad, sólo el número de preguntas realizadas.
La puntuación automática es conveniente en algunas situaciones:</p>
<p>1) ...Cuando el énfasis consiste en estimular la participación, más que en generar una evaluación</p>

<p>2) ...Cuando existe confianza en la calidad media de los textos de los estudiantes..</p>

<p>En otros casos es probablemente preferible mantener bajo el porcentaje de puntuación Automática.</p>

<p>La calificación Manual depende de la evaluación que usted, el profesor, realice al revisar explícitamente
cada pregunta introducida, lo que supone una mucho mayor dedicación. Si especifica un 50% de ratio Automática/Manual,
la mitad de la nota final dependerá de su calificación expresa. Obviamente se puede puntuar diferentemente cada pregunta,
la calificación final será calculada a partir de la media de las calificaiones manuales, multiplicada por su porcentaje de ratio.
Así, siguiendo el ejemplo de 10 preguntas requeridas, con una ratio Automática/Manual del 50% y un estudiante que realiza
7 preguntas, su calificación final será calculada de esta manera:</p>

<p>Puntuación Automática = 7/10 x 50% = 35%</p>

<p>Puntuación Manual = (60% + 70% +50% + 80% + 60% + 40% + 60%)/7 x 35% = 21%</p>

<p>Total = 35% + 21% = 56%</p>

<p>
Otro ejemplo:<br />
Aquí lso estudaintes deben crear al menos 5 preguntas. La ratio Automática/Manual es 20%/80%.<br />
Un estudiante introduce las 5 preguntas, por lo tanto recibe el 20% de la nota final automáticamente. Pero
la caliad de cada pregunta introducida es dispar. Como resultado la calificación del estudiante podría
aparecer como algo parecido a esto::<br />
<table style="text-align: left; width: 253px;" border="1"
 cellpadding="2" cellspacing="2">
  <tbody>
    <tr>
      <td style="width: 90px;"><br />
      </td>
      <td style="width: 70px;">Calificación Automática(20%)</td>
      <td style="width: 70px;">Calificación Manual(80%)</td>
    </tr>
    <tr>
      <td style="width: 90px;">Pregunta 1</td>
      <td style="width: 70px;">100%</td>
      <td style="width: 70px;">20%</td>
    </tr>
    <tr>
      <td style="width: 90px;">Pregunta 2</td>
      <td style="width: 70px;">100%</td>
      <td style="width: 70px;">60%</td>
    </tr>
    <tr>
      <td style="width: 90px;">Pregunta 3</td>
      <td style="width: 70px;">100%</td>
      <td style="width: 70px;">40%</td>
    </tr>
    <tr>
      <td style="width: 90px;">Pregunta 4</td>
      <td style="width: 70px;">100%</td>
      <td style="width: 70px;">80%</td>
    </tr>
    <tr>
      <td style="width: 90px;">Pregunta 5</td>
      <td style="width: 70px;">100%</td>
      <td style="width: 70px;">90%</td>
    </tr>
    <tr>
      <td style="font-weight: bold; width: 90px;">sub-total</td>
      <td style="font-weight: bold; width: 70px;">100%</td>
      <td style="font-weight: bold; width: 70px;">58%</td>
    </tr>
    <tr>
      <td style="font-weight: bold; width: 90px;">Total
for activity</td>
      <td style="font-weight: bold; width: 70px;">20%</td>
      <td style="font-weight: bold; width: 70px;">46.4%</td>
    </tr>
    <tr align="right">
      <td style="width: 70px;" colspan="3" rowspan="1"><span
 style="font-weight: bold;">= 66.4%</span></td>
    </tr>
  </tbody>
</table>

</p>
<?php
$string['graderatio_help'] = ob_get_clean();

ob_start();
?>
<h1>Tipos de preguntas requeridos</h1>

<p>Aquí puede especificar los tipos (formatos) de preguntas que deben ser introducidas. Si selecciona "Permitir todos los tipos"
entonces los estudiantes podrán realizar cualquier tipo hasta el número de preguntas total especificado.</p>

<p>Si sus estudiantes ya conocen cómo usar el interfaz para crear preguntas y conocen las diferencias entre los distintos
tipos de preguntas entonces está justificado y es seguro seleccionar "Permitir todos los tipos". Sin embargo, si éste no es el
caso, probablemente es mejor especificar aquí un tipo (formato) concreto de pregunat que deseda que realicen los estudiantes.
Se pueden ir introduciendo los distintos tipos por etapas.</p>

<p>Ejemplo 1:</p>
<p>Especifica  '4' como "Total de preguntas requeridas" y en "Tipos de preguntas requeridos" marca "Opción múltiple".
Los estudiantes tendrán que introducir preguntas forzosamente del tipo "opción múltiple", no tendrán posibilidad de
escoger otro tipo. Los menús de más abajo de "Nº mínimo de preguntas a calificar del Tipo" no necesitan ser utilizados.</p>

<p>Ejemplo 2:</p>
<p>Especifica  '4' como "Total de preguntas requeridas" y en "Tipos de preguntas requeridos" marca "Opción múltiple"
y "Emparejamiento". Los estudiantes podrán realizar todas de tipo "Opción múltiple" o todas de tipo "Emparejamiento",
o una mezcla unas de un tipo y otras del otro tipo. <br />Si desea especificar exactamente cuántas preguntas de cada tipo
deben ser introducidas debe utilizar los menús "Nº mínimo de preguntas a calificar del Tipo" de más abajo.
Puede añadir más si lo necesita.</p>

<p>Ejemplo 3:</p>
<p>Especifica  '4' como "Total de preguntas requeridas" y marca "Permitir todos los tipos de preguntas" en
"Tipos de preguntas requeridas", los estudiantes podrán crear preguntas de cualquier tipo. Pueden ser todas del mismo
tipo o cualquier combinación de tipos. Tenga en cuenta que los menús "Nº mínimo de preguntas a calificar del Tipo"
pueden usarse para especificar una combinación mínima de tipos de preguntas. O pueden deshabilitarse para no exigir
ningún tipo en particular. </p>
<?php
$string['allowedqtypes_help'] = ob_get_clean();

$string['noofquestionstotal_help'] = '<h1>Total de preguntas requeridas</h1>
<p>Este es el número totas de preguntas (de cualquier tipo) que desea que cada estudiante genere usando esta actividad.
Eset numero debe ser igual o mayor que la suma de los números mínimos de preguntas de cada tipo especificado
(si se especifica alguno). El tipo (formato) de preguntas que será posible generar depende las otras opciones.</p>
<p>El total de preguntas requeridas se emplea para calcular la fracción de calificación automática (si se usa esta opción)
pero no limita el número de preguntas que los estudiantes pueden introducir y almacenar. Los estudiantes siempre pueden
generar preguntas "extra" por encima de este número total de preguntas, sin límite alguno.</p>';

$string['studentqaccess_help'] = '<h1>Acceso de los estudiantes a las preguntas</h1>

<p>De forma genérica, dentro de este módulo los estudiantes sólo tienen acceso a sus propias preguntas, nunca a
las generadas por sus compañeros. </p>

<p>Este menú especifica el grado de acceso que desea otorgar a cada estudiante a las preguntas que él mismo
ha generado previamente. Hay cuatro tipos o grados de acceso:</p>

<p>1) Sólo crear:
<br />Este es el modo más limitado. Una vez que el estudiante termina de editar y guarda el texto
de una pregunta no podrá verla ni editarla más, queda fuera de su alcance.</p>

<p>2) Previsualizar:
<br />Puede ver la pregunta introducida tal y como se mostraría en pantalla en un Cuestionario</p>

<p>3) Previsualizar / Guardar como nueva:
<br />Además de ver las preguntas puede "copiar" una para usarla como base para generar una nueva
pregunta. Sin embargo, el estudiante no puede editar o borrar las preguntas ya generadas y guardadas.</p>

<p>4) Previsualizar / Guardar como nueva / Editar / Borrar:
<br />Este es el nivel de acceso más alto que puede otorgar a un estudiante. El estudiante puede editar y cambiar
las preguntas generadas anteriormente, así como borrar aquellas que no considere satisfactorias. <br />
Si usted desea una actividad en la que los estudiantes puedan desarrollar intaractivamente su habilidad
para crear, valorar y mejorar las preguntas generadas este es el nivel de acceso adecuado.</p>';

$string['qtype_help'] = '<h1>Tipo de pregunta</h1>
<p>En este menú puede especificar qué tipo (formato) de pregunta concreto desea que generen los estudiantes.</p>
<p>Ejemplo:
<p>Usted queire que los estudiantes introduzcan un de 5 preguntas, 3 de Opción múltiple y 2 de Emparejamiento.</p>
<p>Configurelo de esta forma:</p>
<p>1) en el menú "Total de preguntas requeridas" seleccione 5</p>
<p>2) en "Tipos de preguntas requeridos" marque las dos casillas "Opción múltiple" y "Emparejamiento"</p>
<p>3) En el primer bloque "Nº mínimo de preguntas a calificar del Tipo" :</p>
<p>...en el menú Tipo de Pregunta seleccione "Opción múltiple"</p>
<p>...y en Preguntas mínimas seleccione 3</p>
<p>4) En el segundo bloque "Nº mínimo de preguntas a calificar del Tipo" :</p>
<p>...en el menú Tipo de Pregunta seleccione "Emparejamiento"</p>
<p>...y en Preguntas mínimas seleccione 2</p>';

$string['minimumquestions_help'] = '<h1>Nº mínimo de preguntas</h1>
<p>En eset menú puede especificar cuantas preguntas de un tipo (formato) concreto debería introducir cada estudiante.</p>
<p>Ejemplo:
<p>Usted desea que cada estudiante introduzcan un total de 10 preguntas, 3 de "Opción múltiple", 2 de "Respuesta corta",
2 de ""Emparejamiento" y además otras 3 de cualquier otra combinación de esso tipos. </p>
<p>Configurelo de esta forma:</p>
<p>1) en el menú "Total de preguntas requeridas" seleccione 10</p>
<p>2) en "Tipos de preguntas requeridos" marque las tres casillas "Opción múltiple", "Respuesta corta" y "Emparejamiento"</p>
<p>3) En el primer bloque "Nº mínimo de preguntas a calificar del Tipo" :</p>
<p>...en el menú Tipo de Pregunta seleccione "Opción múltiple"</p>
<p>...y en Preguntas mínimas seleccione 3</p>
<p>4) En el segundo bloque "Nº mínimo de preguntas a calificar del Tipo":</p>
<p>...en el menú Tipo de Pregunta seleccione "Respuesta corta"</p>
<p>...y en Preguntas mínimas seleccione 2</p>
<p>5) En el tercer bloque "Nº mínimo de preguntas a calificar del Tipo" :</p>
<p>...en el menú Tipo de Pregunta seleccione "Emparejamiento"</p>
<p>...y en Preguntas mínimas seleccione 2</p>';
