<?php

//$CFG->dataroot "F:\MoodleWindowsInstaller-latest-400\server\moodledata"

/*
TODO:
- [ ] Obtener ID del profesor, sus respectivos paises, del nivel y de la materia
- [ ] Calcular monto total del profesor
*/

require_once(__DIR__ . '/../../config.php');
require_once('./simple_form.php');
require_once('./utils/db_operations.php');
require_once('./utils/custom_functions.php');

global $PAGE;
global $DB;

$PAGE->set_context(get_system_context());
$PAGE->set_pagelayout('admin');
$PAGE->set_title("Cargar Clase");
$PAGE->set_heading("Cargar Clase");
$PAGE->set_url($CFG->wwwroot.'/blank_page.php');


check_if_allowed();

$mform = new cargar_clase_formulario();

//Form processing and displaying is done here
if ($mform->is_cancelled()) {
  redirect($CFG->wwwroot);

} else if ($fromform = $mform->get_data()) {
  
  $id_alumno = intval($fromform->nombreAlumno) + 1;
  $nivel_alumno = get_nivel_alumno($id_alumno);
  
  $clase_data = new stdClass();

  $clase_data->Alumno_ID = $id_alumno;
  $clase_data->Alumno_Pais = get_pais_id_alumno($id_alumno);
  $clase_data->Nivel_Alumno = $nivel_alumno;
  
  $clase_data->Profesor_ID = 999; // Sacar automaticamente de la session
  $clase_data->Profesor_Pais = 0; // Una vez que tengo el nombre, hago funcion para que me traiga este valor
  $clase_data->Monto_Profesor = 0;

  $clase_data->Horas = $fromform->duracionClase;
  $clase_data->Materia_ID = $fromform->materia;
  $clase_data->Comentarios = $fromform->comentarios;
  $clase_data->Nivel = intval($fromform->nivel) + 1;
  $clase_data->Monto = calcular_monto_clase($nivel_alumno);

  $clase_data->Fecha = convert_time($fromform->fechaClase, 'America/Argentina/Buenos_Aires'); // Aca le deberia pasar el ID del pais del profesor y buscar en una liste el que corresponde

  // set_clase($clase_data);
  redirect($CFG->wwwroot . '/my');
  
} else {
  $mform->set_data($toform);
}

// $templatecontext = [
//   'materias' => $materias,
// ];

echo $OUTPUT->header();
// echo $OUTPUT->render_from_template('local_form/form', $templatecontext);

$mform->display();

echo $OUTPUT->footer();
?>