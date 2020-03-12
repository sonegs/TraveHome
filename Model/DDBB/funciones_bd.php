<?php

/*

***************************************************************************
************************ FUNCIONES DE LOS USUARIOS VIAJEROS ************************
***************************************************************************

*/

// INSERTAR USUARIOS

function insertarViajeros() { // le pasamos los valores necesarios para insertar un registro

    include "conexion.php";
    
    // Recogemos los valores del formulario de registro

    $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;
    $apellidos = isset($_POST['apellidos']) ? $_POST['apellidos'] : false;
    $dni = isset($_POST['dni']) ? $_POST['dni'] : false;
    $email = isset($_POST['email']) ? $_POST['email'] : false;
    $contrasena = isset($_POST['contrasena']) ? $_POST['contrasena'] : false;
    $direccion = isset($_POST['direccion']) ? $_POST['direccion'] : false;
    $cp = isset($_POST['cp']) ? $_POST['cp'] : false;
    $ciudad = isset($_POST['ciudad']) ? $_POST['ciudad'] : false;
    $pais = isset($_POST['pais']) ? $_POST['pais'] : false;
    $telefono = isset($_POST['telefono']) ? $_POST['telefono'] : false;
    
    
    // Validamos la información antes de insertarla

    $errores = array();

    if ($nombre && !is_numeric($nombre) && !preg_match("/[0-9]/", $nombre)) {
        $nombre_validado = true;
    } else {
        $nombre_validado = false;
        $errores['nombre'] = "El campo nombre es inválido";
    }
    if ($apellidos && !is_numeric($apellidos) && !preg_match("/[0-9]/", $apellidos)) {
        $apellidos_validado = true;
    } else {
        $apellidos_validado = false;
        $errores['apellidos'] = "El campo apellidos es inválido";
    }
    if (!empty($dni)) {
        $dni_validado = true;
    } else {
        $dni_validado = false;
        $errores['dni'] = "El campo DNI está vacía";
    }
    if (!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $email_validado = true;
    } else {
        $email_validado = false;
        $errores['Email'] = "El campo email es inválido";
    }
    if (!empty($contrasena)) {
        $contrasena_validado = true;
    } else {
        $contrasena_validado = false;
        $errores['contrasena'] = "El campo contraseña está vacía";
    }
    if (!empty($direccion)) {
        $direccion_validado = true;
    } else {
        $direccion_validado = false;
        $errores['contrasena'] = "El campo direccion está vacía";
    }
    if ($cp && is_numeric($cp)) {
        $cp_validado = true;
    } else {
        $cp_validado = false;
        $errores['cp'] = "El campo Código Postal es inválido";
    }
    if ($ciudad && !is_numeric($ciudad) && !preg_match("/[0-9]/", $ciudad)) {
        $ciudad_validado = true;
    } else {
        $ciudad_validado = false;
        $errores['ciudad'] = "El campo ciudad es inválido";
    }
    if ($pais && !is_numeric($pais) && !preg_match("/[0-9]/", $pais)) {
        $pais_validado = true;
    } else {
        $pais_validado = false;
        $errores['pais'] = "El campo pais es inválido";
    }
    if ($telefono && is_numeric($telefono)) {
        $telefono_validado = true;
    } else {
        $telefono_validado = false;
        $errores['telefono'] = "El campo teléfono es inválido";
    }
    $guardar_usuario = false;
    if(count($errores) == 0) {
        $guardar_usuario = true;
        $contrasena_segura = password_hash($contrasena, PASSWORD_BCRYPT, ['opciones' => 4]);
    } else {
        echo "<h5>Hay algun error en los datos rellenados. Por favor, compruebe que se han introducido correctamente</h5>";
    }

    $query = "INSERT INTO Users (Name, Surname, DNI, Address, PC, City, Country, Email, Password, Phone) VALUES ('$nombre','$apellidos','$dni','$direccion','$cp','$ciudad','$pais','$email','$contrasena_segura', '$telefono');";    


    if (mysqli_query($con, $query)) {

        echo "<h1>Se ha introducido correctamente</h1>";

    } else{

        echo "<h1>Se ha producido un error en la consulta</h1>";
        var_dump($con);
        var_dump($query);

    }
    $con -> close();


}

// ELIMINAR USUARIOS

function eliminarViajeros($email, $contrasena) { // hay que pasarle variables de verificación para identificar el usuario que vamos a eliminar

    include "conexion.php";
    $email = $_POST['email'];
    $contrasena = $_POST['contrasena'];
    
    $query= "DELETE FROM Users WHERE email = '$email' AND Password = '$contrasena'";
    
    if (mysqli_query($con, $query)) {

        echo "<h1>Se ha eliminado correctamente</h1>";

    } else{

        echo "<h1>Se ha producido un error, ¿ha introducido los datos correctamente?</h1>";

    }

    $con -> close();

}


// EDITAR USUARIOS

function editarViajeros($nombre,$apellidos,$dni,$direccion,$cp,$ciudad,$pais,$email,$contrasena, $telefono) { // hay que pasarle las variables nombre y contraseña para identificar al usuario que vamos a eliminar

    include "conexion.php";
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $dni = $_POST['dni'];
    $email = $_POST['email'];
    $contrasena = isset($_POST['contrasena']) ? $_POST['contrasena'] : false;
    $direccion = $_POST['direccion'];
    $cp = $_POST['cp'];
    $ciudad = $_POST['ciudad'];
    $pais = $_POST['pais'];
    $telefono = $_POST['telefono'];


    $query= "UPDATE Users SET Name ='$nombre', Surname ='$apellidos', DNI ='$dni', Email = '$email', Password = '$contrasena', Address = '$direccion', PC = '$cp', City = '$ciudad', Country = '$pais', Phone = '$telefono' WHERE email = '$email' AND Password = '$contrasena'";
    
        if (mysqli_query($con, $query)) {
            
            echo "<h1>Se ha introducido correctamente</h1>";
            
    
        } else{
            
            echo "<h1>Se ha producido un error en la consulta, ¿ha introducido los datos correctamente?</h1>";
    
        }
        $con -> close();

}

/*

***************************************************************************
************************ FUNCIONES DE LOS USUARIOS PROPIETARIOS ************************
***************************************************************************

*/


// INSERTAR PROPIETARIOS

function insertarPropietarios() { // le pasamos los valores necesarios para insertar un registro

    include "conexion.php";
    
    // Recogemos los valores del formulario de registro

    $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;
    $apellidos = isset($_POST['apellidos']) ? $_POST['apellidos'] : false;
    $dni = isset($_POST['dni']) ? $_POST['dni'] : false;
    $email = isset($_POST['email']) ? $_POST['email'] : false;
    $contrasena = isset($_POST['contrasena']) ? $_POST['contrasena'] : false;
    $direccion = isset($_POST['direccion']) ? $_POST['direccion'] : false;
    $cp = isset($_POST['cp']) ? $_POST['cp'] : false;
    $ciudad = isset($_POST['ciudad']) ? $_POST['ciudad'] : false;
    $pais = isset($_POST['pais']) ? $_POST['pais'] : false;
    $telefono = isset($_POST['telefono']) ? $_POST['telefono'] : false;
    
    
    // Validamos la información antes de insertarla

    $errores = array();

    if ($nombre && !is_numeric($nombre) && !preg_match("/[0-9]/", $nombre)) {
        $nombre_validado = true;
    } else {
        $nombre_validado = false;
        $errores['nombre'] = "El campo nombre es inválido";
    }
    if ($apellidos && !is_numeric($apellidos) && !preg_match("/[0-9]/", $apellidos)) {
        $apellidos_validado = true;
    } else {
        $apellidos_validado = false;
        $errores['apellidos'] = "El campo apellidos es inválido";
    }
    if (!empty($dni)) {
        $dni_validado = true;
    } else {
        $dni_validado = false;
        $errores['dni'] = "El campo DNI está vacía";
    }
    if (!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $email_validado = true;
    } else {
        $email_validado = false;
        $errores['Email'] = "El campo email es inválido";
    }
    if (!empty($contrasena)) {
        $contrasena_validado = true;
    } else {
        $contrasena_validado = false;
        $errores['contrasena'] = "El campo contraseña está vacía";
    }
    if (!empty($direccion)) {
        $direccion_validado = true;
    } else {
        $direccion_validado = false;
        $errores['contrasena'] = "El campo direccion está vacía";
    }
    if ($cp && is_numeric($cp)) {
        $cp_validado = true;
    } else {
        $cp_validado = false;
        $errores['cp'] = "El campo Código Postal es inválido";
    }
    if ($ciudad && !is_numeric($ciudad) && !preg_match("/[0-9]/", $ciudad)) {
        $ciudad_validado = true;
    } else {
        $ciudad_validado = false;
        $errores['ciudad'] = "El campo ciudad es inválido";
    }
    if ($pais && !is_numeric($pais) && !preg_match("/[0-9]/", $pais)) {
        $pais_validado = true;
    } else {
        $pais_validado = false;
        $errores['pais'] = "El campo pais es inválido";
    }
    if ($telefono && is_numeric($telefono)) {
        $telefono_validado = true;
    } else {
        $telefono_validado = false;
        $errores['telefono'] = "El campo teléfono es inválido";
    }
    
    $guardar_usuario = false;
    if(count($errores) == 0) {
        $guardar_usuario = true;
        $contrasena_segura = password_hash($contrasena, PASSWORD_BCRYPT, ['opciones' => 4]);
    } else {
        echo "<h5>Hay algun error en los datos rellenados. Por favor, compruebe que se han introducido correctamente</h5>";
    }

    $query = "INSERT INTO Owners (Name, Surname, DNI, Address, PC, City, Country, Email, Password, Phone) VALUES ('$nombre','$apellidos','$dni','$direccion','$cp','$ciudad','$pais','$email','$contrasena_segura', '$telefono');";    


    if (mysqli_query($con, $query)) {

        echo "<h1>Se ha introducido correctamente</h1>";

    } else{

        echo "<h1>Se ha producido un error en la consulta</h1>";

    }
    $con -> close();

}

// ELIMINAR PROPIETARIOS

function eliminarPropietarios($email, $contrasena) { // hay que pasarle variables de verificación para identificar el usuario que vamos a eliminar

    include "conexion.php";
    $email = $_POST['email'];
    $contrasena = $_POST['contrasena'];
    
    $query= "DELETE FROM Owners WHERE email = '$email' AND Password = '$contrasena'";
    
    if (mysqli_query($con, $query)) {

        echo "<h1>Se ha eliminado correctamente</h1>";

    } else{

        echo "<h1>Se ha producido un error, ¿ha introducido los datos correctamente?</h1>";

    }

    $con -> close();

}


// EDITAR PROPIETARIOS

function editarPropietarios($nombre,$apellidos,$dni,$direccion,$cp,$ciudad,$pais,$email,$contrasena, $telefono) { // hay que pasarle las variables nombre y contraseña para identificar al usuario que vamos a eliminar

    include "conexion.php";
    $nombre = $_POST['nombre'];
    $apellidos = $_POST['apellidos'];
    $dni = $_POST['dni'];
    $email = $_POST['email'];
    $contrasena = isset($_POST['contrasena']) ? $_POST['contrasena'] : false;
    $direccion = $_POST['direccion'];
    $cp = $_POST['cp'];
    $ciudad = $_POST['ciudad'];
    $pais = $_POST['pais'];
    $telefono = $_POST['telefono'];


    $query= "UPDATE Owners SET Name ='$nombre', Surname ='$apellidos', DNI ='$dni', Email = '$email', Password = '$contrasena', Address = '$direccion', PC = '$cp', City = '$ciudad', Country = '$pais', Phone = '$telefono' WHERE email = '$email' AND Password = '$contrasena'";
    
        if (mysqli_query($con, $query)) {
            
            echo "<h1>Se ha introducido correctamente</h1>";
            
    
        } else{
            
            echo "<h1>Se ha producido un error en la consulta, ¿ha introducido los datos correctamente?</h1>";
    
        }
        
        $con -> close();

}


?>

