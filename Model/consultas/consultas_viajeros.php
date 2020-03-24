<?php

/*

***************************************************************************
************************ FUNCIONES DE LOS USUARIOS VIAJEROS ***************
***************************************************************************

*/

// INSERTAR USUARIOS

function insertarViajeros() { // le pasamos los valores necesarios para insertar un registro

    include "Model/DDBB/conexion.php";
    
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
        $errores['direccion'] = "El campo direccion está vacía";
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

    $query = "INSERT INTO Users (Name, Surname, DNI_traveller, Address, PC, City, Country, Email, Password, Phone) VALUES ('$nombre','$apellidos','$dni','$direccion','$cp','$ciudad','$pais','$email','$contrasena_segura', '$telefono');";    
    

    if (mysqli_query($con, $query)) {

        echo "<h1>Se ha introducido correctamente</h1>";
        
    } else{

        echo "<h1>Su DNI coincide con el de otro usuario ya registrado</h1>";
        //var_dump($con);
        //var_dump($query);

    }

    $con -> close();

}

// ELIMINAR USUARIOS

function eliminarViajeros() { 
    session_start();
    include "Model/DDBB/conexion.php";
    
    $id = $_SESSION['traveller']['ID']; // coge el id del usuario actual

    // formamos la query para eliminar el usuario

    $query= "DELETE FROM Users WHERE ID = '$id'";
    
    if (mysqli_query($con, $query)) {

        echo "<h1>Se ha eliminado correctamente</h1>";
        unset($_SESSION['traveller']);
        
    } else{

        echo "<h1>Se ha producido un error, ¿ha introducido los datos correctamente?</h1>";

    }

    $con -> close();

}

// EDITAR USUARIOS

function editarViajeros($dni, $direccion, $cp, $ciudad, $pais, $email, $contrasena, $telefono) { // hay que pasarle las variables nombre y contraseña para identificar al usuario que vamos a eliminar

    include "Model/DDBB/conexion.php";

    $dni = $_POST['dni'];
    $email = $_POST['email'];
    $contrasena = isset($_POST['contrasena']) ? $_POST['contrasena'] : false;
    $direccion = $_POST['direccion'];
    $cp = $_POST['cp'];
    $ciudad = $_POST['ciudad'];
    $pais = $_POST['pais'];
    $telefono = $_POST['telefono'];

    //validamos los datos
    
    $errores = array();

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
        $errores['direccion'] = "El campo direccion está vacía";
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
        $con -> close();

    }

    // La query se elige en función del tipo de usuario
    $query= "UPDATE Users SET Email = '$email', Password = '$contrasena_segura', Address = '$direccion', PC = '$cp', City = '$ciudad', Country = '$pais', Phone = '$telefono' WHERE DNI_traveller = '$dni'";

    if (mysqli_query($con, $query)) {
        
        $tested = mysqli_affected_rows($con); // comprueba que se ha modificado el registro

        if($tested != 0) {
 
            echo "<h4>Se actualizaron tus datos</h4>";

            } else {
                
                echo "<h4>Se ha producido un error en la consulta, ¿ha introducido su DNI correctamente?</h4>";

                exit();

            }
        
    } else {
            
        echo "<h4>Se ha producido un error en la consulta, ¿ha introducido sus datos correctamente?</h4>";
    
        }

    $con -> close();

}

// ENVIAR CONTRASEÑA AL USUARIO

function forgetViajeros(){

    include "Model/DDBB/conexion.php";

    $email = $_POST['email'];
    
    if (!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $email_validado = true;
    } else {
        $email_validado = false;
        echo "El campo email es inválido";
    }

    $query = "SELECT Email, Name, Surname FROM Users WHERE Email = '$email'";
    //var_dump($query);
    $envioQuery = mysqli_query($con, $query);
    if ($element = mysqli_fetch_row($envioQuery)) {
    
        $mensaje = "Hola $element[1] $element[2], <br><br>

        Has solicitado restablecer la contraseña de tu usuario en la web de TraveHome. Por favor, haga click en el siguiente enlace<br><br>
        
        <a href='index.php?nu=%207'>Restablecer contraseña</a><br><br>

        Si no has solicitado una nueva contraseña, por favor, ignora este e-mail.<br><br>

        Un saludo<br><br>
        
        El equipo de TraveHome";

        if(mail($element[0], 'Confirmación de contraseña', $mensaje)){
            
            echo "Se ha enviado un email a su dirección de correo electrónico";

        } else {

            echo "Ha habido algun error a la hora de enviarle su email. Por favor, póngase en contacto con nosotros";

        };
        
        //var_dump(mail($fila[0], 'Confirmación de contraseña', $mensaje));

    } else {

        echo "<h4>Esa dirección de email no ha sido registrada anteriormente</h4>";
    
    }
}

// CAMBIAR CONTRASEÑA DEL USUARIO

function reminderViajeros($email, $contrasena) {

    include "Model/DDBB/conexion.php";
    $email = $_POST['email'];
    $contrasena = isset($_POST['contrasena']) ? $_POST['contrasena'] : false;

    $errores = array();


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

    $guardar_usuario = false;
    
    if(count($errores) == 0) {

        $guardar_usuario = true;
        $contrasena_segura = password_hash($contrasena, PASSWORD_BCRYPT, ['opciones' => 4]);
        

    } else {

        echo "<h5>Hay algun error en los datos rellenados. Por favor, compruebe que se han introducido correctamente</h5>";
        $con -> close();

    }

    $query = "UPDATE Users SET Password = '$contrasena_segura' WHERE Email = '$email'";

    if (mysqli_query($con, $query)) {
        
        $tested = mysqli_affected_rows($con); // comprueba que se ha modificado el registro

        if($tested != 0) {
 
            echo "<h4>Se actualizaron tus datos</h4>";

            } else {
                
                echo "<h4>Su correo electrónico no consta en nuestra base de datos, por favor, compruebelo y vuelva a intentarlo</h4>";

                exit();

            }
        
    } else {
            
        echo "<h4>Se ha producido un error en la consulta, ¿ha introducido sus datos correctamente?</h4>";
    
        }

    $con -> close();

}

?>

