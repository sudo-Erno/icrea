<?php

// require_once(__DIR__ . '/../../config.php');

// date_default_timezone_set(); // Depende del pais. Tener en cuenta para cuando se expanda
function convert_time($unixtime, $timezone){
    $datetime = new DateTime();
    $datetime = DateTime::createFromFormat('U', $unixtime);
    $formated_date = new DateTime($datetime->date, new DateTimeZone($timezone));
    return $formated_date->format('Y-m-d H:i:s');
}

?>