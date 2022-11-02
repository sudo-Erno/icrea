<?php

require_once(__DIR__ . '/../../config.php');

function get_materias(){
    global $DB;
    $materias[] = array();
    $query_materias = $DB->get_records_sql('SELECT Nombre FROM Materias;');
    
    foreach ($query_materias as $materia){
        array_push($materias, $materia->nombre);
    }
    unset($materias[0]);
    
    return $materias;
}

function get_nombres_apellidos_alumnos(){
    global $DB;
    $alumnos = array();
    $query_nombres = $DB->get_records_sql('SELECT Nombre, Apellido FROM Alumnos;');
    
    foreach($query_nombres as $al){
        array_push($alumnos, $al->nombre . ' ' . $al->apellido);
    }

    return $alumnos;
}

function set_clase($data_clase){
    global $DB;
    $DB->insert_record('clases', $data_clase);    
}

?>