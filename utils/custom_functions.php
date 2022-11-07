<?php

// F:\MoodleWindowsInstaller-latest-400\server\moodle\local\form

require_once(__DIR__ . '/../../../config.php');

// date_default_timezone_set(); // Depende del pais. Tener en cuenta para cuando se expanda
function convert_time($unixtime, $timezone){
    $datetime = new DateTime();
    $datetime = DateTime::createFromFormat('U', $unixtime);
    $formated_date = new DateTime($datetime->date, new DateTimeZone($timezone));
    return $formated_date->format('Y-m-d H:i:s');
}


// Dada el nivel de clase, te el precio TOTAL de la clase
function calcular_monto_clase($nivel){
    // 1 -> Ingreso Uni.
    // 2 --> Ingreso Uni. ex. 
    // 3 --> Primario
    // 4 --> Primario ex.
    // 5 --> Secundario
    // 6 --> Secundario ex.
    // 7 --> Uni.
    // 8 --> Uni. ex.

    if ($nivel == 1 or $nivel == 2){
        return 1390;
    } elseif ($nivel == 3 or $nivel == 4){
        return 1130;
    } elseif ($nivel == 5 or $nivel == 6){
        return 1250;
    } elseif ($nivel == 7){
        return 1550;
    } elseif ($nivel == 8){
        return 1680;
    }
}

// Calcula monto del profesor
function calcular_monto_prof($nivel_profesor, $nivel_clase){
    $monto = calcular_monto_clase($nivel_clase);
    $aumento = 0;
        
    if ($nivel_profesor < 9){
        $aumento = 100 + ($nivel_profesor * 5 - 5);
        $aumento = $aumento / 100;
    } elseif ($nivel_profesor == 9){
        $aumento = 1.45;
    } elseif ($nivel_profesor == 10){
        $aumento = 1.55;
    }
    return $monto * $aumento;
}

function check_if_allowed(){
    if (!is_siteadmin()){
        // $templatecontext = [
        //     'link' => $CFG->wwwroot . '/my',
        // ];
        
        // echo $OUTPUT->render_from_template('./form', $templatecontext);
        
        die('Solo los profesores pueden acceder a esta seccion!');
        // redirect();
    }
}

?>