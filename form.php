<?php

//$CFG->dataroot "F:\MoodleWindowsInstaller-latest-400\server\moodledata"

// TODO: Obtener ID del profesor, alumno, de sus respectivos paises, del nivel y de la materia

require_once(__DIR__ . '/../../config.php');
require_once('./simple_form.php');
require_once('./utils/db_operations.php');
require_once('./utils/custom_functions.php');

$PAGE->set_context(get_system_context());
$PAGE->set_pagelayout('admin');
$PAGE->set_title("Cargar Clase");
$PAGE->set_heading("Cargar Clase");
$PAGE->set_url($CFG->wwwroot.'/blank_page.php');

global $DB;

$mform = new cargar_clase_formulario();

//Form processing and displaying is done here
if ($mform->is_cancelled()) {
  redirect($CFG->wwwroot);
} else if ($fromform = $mform->get_data()) {
  $id_alumno = intval($fromform->nombreAlumno) + 1;
  
  $clase_data = new stdClass();

  $clase_data->Alumno_ID = $id_alumno;
  $clase_data->Profesor_ID = 999; // Sacar automaticamente de la session
  $clase_data->Horas = $fromform->duracionClase;
  $clase_data->Fecha = convert_time($fromform->fechaClase, 'America/Argentina/Buenos_Aires');
  $clase_data->Materia_ID = $fromform->materia;
  $clase_data->Comentarios = $fromform->comentarios;
  $clase_data->Profesor_Pais = 0; // Una vez que tengo el nombre, hago funcion para que me traiga este valor
  $clase_data->Alumno_Pais = get_pais_id_alumno($id_alumno);
  $clase_data->Nivel = 0;
  $clase_data->Monto = 9999; // Se calcula dependiendo el nivel, horas y nivel del profesor
  
  set_clase($clase_data);
  redirect($CFG->wwwroot . '/my');
  
} else {
  $mform->set_data($toform);
}

$templatecontext = [
  'materias' => $materias,
];

echo $OUTPUT->header();
echo $OUTPUT->render_from_template('local_form/form', $templatecontext);

$mform->display();

echo $OUTPUT->footer();
?>