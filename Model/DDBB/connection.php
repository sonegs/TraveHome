<?php

// Parametros de conexión

$host = "localhost"; // Este es el servidor local o localhost
$bd = "travehome"; // nombre de la base de datos
$user = "root"; // usuario que tiene acceso
$pass = "granobra33"; // la constraseña de la BBDD

$con = new mysqli($host, $user, $pass); // Conexión a nuestro Sistema Gestor de Base de Datos (MySQL)

if (mysqli_connect_errno()) { // este if controla los errores en la conexión

    echo "Connection failed: ".$con->connect_error;
    echo "La conexión ha fallado";
    exit();

}

mysqli_select_db($con, $bd) or die("<h1>Error en la conexión a la base de datos</h1>"); // Conexión a nuestra base de datos

mysqli_set_charset($con, "UTF8"); // La conexión devuelve los datos con caracteres en español (acentos, tildes, etc)

?>