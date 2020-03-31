<?php

//include "Model/DDBB/connection.php";

// Como la fecha viene en formato ingles, establecemos el localismo.
setlocale(LC_ALL, 'en_US');

// Fecha en formato yyyy/mm/dd
$timestamp1 = strtotime($tripStart);
$timestamp2 = strtotime($tripEnd);

// Fecha en formato dd/mm/yyyy
$checkin = strftime("%d/%m/%Y", $timestamp1);
$checkout = strftime("%d/%m/%Y", $timestamp2);

//$con->close();

?>