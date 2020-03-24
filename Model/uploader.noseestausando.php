<?php

session_start(); // inicio de sesion

// Declaración de variables

$uploadedfileload = 'true';
$uploadedfile_size = $_FILES['uploadedfile'][200000];
$id = $_SESSION['owner']['ID'];
$nombreImagen = $_FILES['uploadedfile']['name'];
$name_img = date('Y-m-d-h:i:s').'-'.$id.'-'.$nombreImagen; //cambia el nombre de la imagen subida a uno único
$uploads_dir = '../View/uploads/'.$name_img;
//echo $nombreImagen;

if ($_FILES['uploadedfile']['size'] > 200000) { // si la imagen pesa más de 200KB
    
    $msg = $msg."<h4>El archivo es mayor que 20 KB, debes reduzcirlo antes de subirlo</h4><br>";
    $uploadedfileload="false";

}

if (!($_FILES['uploadedfile']['type'] == 'image/jpeg' OR !$_FILES['uploadedfile']['type'] == 'image/gif' OR !$_FILES['uploadedfile']['type'] == 'image/png' OR !$_FILES['uploadedfile']['type'] == 'image/jpg')) {
// Si la imagen no tiene un formato de imagen válido
    $msg = $msg."<h4>Tu archivo tiene que ser JPG o GIF. Otros archivos no son permitidos</h4><br>";

    $uploadedfileload="false";

}
        
if ($uploadedfileload == true) { // si no hay errores
            
    if(move_uploaded_file ($_FILES['uploadedfile']['tmp_name'], $uploads_dir)){ // si se ha movido la imagen
        
        echo 'La imagen ha sido subido satisfactoriamente'; 
        
    } else {

        echo 'Ha ocurrido un problema al subir la imagen de su vivienda';

    }
      
}
    
?>