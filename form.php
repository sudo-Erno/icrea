<?php

//$CFG->dataroot "F:\MoodleWindowsInstaller-latest-400\server\moodledata"

// TODO: Obtener ID del profesor, alumno, de sus respectivos paises, del nivel y de la materia

require_once(__DIR__ . '/../../config.php');
require_once('./simple_form.php');
require_once('./db_operations.php');

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
  $clase_data = new stdClass();
  $clase_data->Profesor_ID = 999;
  $clase_data->Alumno_ID = 999;
  // $clase_data->Fecha = $fromform->fechaClase;
  $clase_data->Horas = $fromform->duracionClase;
  $clase_data->Materia_ID = 42;
  $clase_data->Comentarios = $fromform->comentarios;
  $clase_data->Profesor_Pais = 0;
  $clase_data->Alumno_Pais = 0;
  $clase_data->Nivel = 0;
  $clase_data->Monto = 9999;

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