<?php

// require_once('./data/metricas.php');

// date_default_timezone_set(); // Depende del pais. Tener en cuenta para cuando se expanda
function convert_time($unixtime, $timezone){
    $datetime = new DateTime();
    $datetime = DateTime::createFromFormat('U', $unixtime);
    $formated_date = new DateTime($datetime->date, new DateTimeZone($timezone));
    return $formated_date->format('Y-m-d H:i:s');
}


function calcular_monto($nivel_clase, $nivel_profesor){
    // 1 -> Ingreso Uni.
    // 2 --> Ingreso Uni. ex. 
    // 3 --> Primario
    // 4 --> Primario ex.
    // 5 --> Secundario
    // 6 --> Secundario ex.
    // 7 --> Uni.
    // 8 --> Uni. ex.
    $precio_clase;

    if ($nivel_clase == 1 or $nivel_clase == 2){
        $precio_clase = 1390;
    } elseif ($nivel_clase == 3 or $nivel_clase == 4){
        $precio_clase = 1130;
    } elseif ($nivel_clase == 5 or $nivel_clase == 6){
        $precio_clase = 1250;
    } elseif ($nivel_clase == 7){
        $precio_clase = 1550;
    } elseif ($nivel_clase == 8){
        $precio_clase = 1680;
    }

    return $precio_clase;
}

?>