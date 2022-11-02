<?php
//moodleform is defined in formslib.php
require_once("$CFG->libdir/formslib.php");
require_once("./utils/db_operations.php");

$materias = get_materias();
$alumnos = get_nombres_apellidos_alumnos();

class cargar_clase_formulario extends moodleform {
    //Add elements to form
    public function definition() {
        global $CFG;
        global $materias;
        global $alumnos;
       
        $attributes = array('size'=>'75');
        $mform = $this->_form; // Don't forget the underscore! 

        $options = array(
            'multiple' => false,
            'noselectionstring' => 'Seleccione el nombre del alumno'
        );
        $mform->addElement('autocomplete', 'nombreAlumno', 'Nombre del Alumno', $alumnos, $options);

        $mform->addElement('select', 'materia', 'Materia', (array)$materias);
        
        $mform->addElement('textarea', 'comentarios', 'Comentarios acerca de la clase', 'rows=20 cols=50');
        $mform->setType('comentarios', PARAM_NOTAGS);

        // TODO: Esto pude ser un casillero que le ingreses el numero como float
        $mform->addElement('date_selector', 'fechaClase', 'Fecha de la clase');
        $mform->addElement('duration', 'duracionClase', 'Duracion de la clase');

        $this->add_action_buttons($cancel=true, $submitlabel="Click Me!");
    }
    //Custom validation should be added here
    // function validation($data, $files) {
    //     return array();
    // }
}

?>