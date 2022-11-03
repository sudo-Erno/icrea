<?php

require_once(__DIR__ . '/../../../config.php');

$paises_alumnos = array();

function get_materias(){
    global $DB;
    $materias[] = array();
    // TODO: Cambiar este metodo a get_records() para que sea todo mas homogeneo
    $query_materias = $DB->get_records_sql('SELECT Nombre FROM Materias;');
    
    foreach ($query_materias as $materia){
        array_push($materias, $materia->nombre);
    }
    unset($materias[0]);
    
    return $materias;
}

// TODO: No se si esto relentiza, pero encontrar una manera de hacer que no tarde tanto...
function get_nombres_apellidos_alumnos(){
    global $DB;
    $alumnos = array();
    $query_nombres = $DB->get_records("alumnos");
    
    foreach($query_nombres as $al){
        array_push($alumnos, $al->nombre . ' ' . $al->apellido);
    }

    return $alumnos;
}

function get_pais_id_alumno($id_alumno){
    global $DB;
    
    $results = $DB->get_records('alumnos', ['ID' => $id_alumno]);
    // $results = $DB->get_records_sql("SELECT ID, Pais FROM mdl_alumnos WHERE Nombre='$nombre' AND Apellido='$apellido';");

    foreach($results as $r){
        return $r->pais;
    }
}

function set_clase($data_clase){
    global $DB;
    $DB->insert_record('clases', $data_clase);    
}

?>