<?php

/*

***************************************************************************
************************ FUNCIONES DE LOS USUARIOS ************************
***************************************************************************

*/

// LOGIN DE LOS USUARIOS

function login(){
    
    include "Model/DDBB/connection.php";
    
    // Recoger datos del formulario
  
    $email = trim($_POST['email']);
  
    $contrasena = trim($_POST['contrasena']);
    
    $usertype = "";
      
      if(isset($_POST['usertype'])){
        
          $usertype = $_POST['usertype'];
  
          // Consulta con la bbdd para comprobar el email del usuario
  
          if($usertype == 'traveller') {
    
              $query = "SELECT * FROM Travellers WHERE email = '$email'";
    
          }
          
          if ($usertype == 'owner') {
            
              $query = "SELECT * FROM Owners WHERE email = '$email'";
  
          }
    
          $login = mysqli_query($con, $query);
    
          if($login && mysqli_num_rows($login) > 0) { // Comprueba si se han encontrado datos con ese email
            
              $usuario = mysqli_fetch_assoc($login); // recoge un array con los datos de $query
      
              $verify = password_verify($contrasena, $usuario['Password']); // verificar contraseña
              
              if($verify == true){
                
                if($usertype == 'traveller') {
                    
                    $_SESSION['traveller'] = $usuario;
                    header('Location: index.php?tr=%200'); // Redirigir al index.php

                } 
                
                
                if($usertype == 'owner') {
                    
                    $_SESSION['owner'] = $usuario;
                    header('Location: index.php?ow=%200'); // Redirigir al index.php
                    
                } 
                
                if(isset($_SESSION['error_login'])){
          
                  unset($_SESSION['error_login']);
  
                } else { // Si algo falla, enviar una sesion con el fallo
  
                  $_SESSION['error_login'] = "Login incorrecto";
            
                  }
  
                } else {
  
                  echo "<div class='fila-info-owners'>La contraseña que ha introducido no es correcta</div>";
  
                }
              
              } else {
  
                echo "<div class='fila-info-owners'>El email que ha introducido no ha sido registrado en nuestra BBDD.<br><br>Por favor, compruebe su dirección de email y vuelva a introducirlo</div>";
              }
              
        
            } else {
  
              echo "<div class='fila-info-owners'Por favor, seleccione si es un usuario traveller o un usuario owner</div>";
  
            }
           
  } // Fin de la función
  

// INSERTAR USUARIOS

function insertUser() { // le pasamos los valores necesarios para insertar un registro

    include "Model/DDBB/connection.php";
    
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
    $usertype = isset($_POST['usertype']) ? $_POST['usertype'] : false;

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

        echo "<div class='fila-info-owners'>Hay algun error en los datos rellenados. Por favor, compruebe que se han introducido correctamente</div>";
        var_dump($errores);
    }

    if($usertype == 'traveller'){

        $query = "INSERT INTO Travellers (Name, Surname, DNI_traveller, Address, PC, City, Country, Email, Password, Phone) VALUES ('$nombre','$apellidos','$dni','$direccion','$cp','$ciudad','$pais','$email','$contrasena_segura', '$telefono');";    
    

        if (mysqli_query($con, $query)) {

            echo "<div class='fila-info-owners'>Se ha introducido correctamente</div>";
        
        } else{

            echo "<div class='fila-info-owners'>Su DNI coincide con el de otro usuario ya registrado</div>";
            var_dump($con);
            //var_dump($con);
            //var_dump($query);

        }

    }


    if($usertype == 'owner'){

        $query = "INSERT INTO Owners (Name, Surname, DNI_owner, Address, PC, City, Country, Email, Password, Phone) VALUES ('$nombre','$apellidos','$dni','$direccion','$cp','$ciudad','$pais','$email','$contrasena_segura', '$telefono');";    
    

        if (mysqli_query($con, $query)) {

            echo "<div class='fila-info-owners'>Se ha introducido correctamente</div>";
        
        } else{

            echo "<div class='fila-info-owners'Su DNI coincide con el de otro usuario ya registrado</div>";
            //var_dump($con);
            //var_dump($query);

        }
        
    }

    $con -> close();

}

// ELIMINAR USUARIOS

function deleteUser() { 
    
    include "Model/DDBB/connection.php";
    
    if(isset($_SESSION['traveller'])){

        $usertype = 'traveller';
        echo $usertype;
        
    }

    if(isset($_SESSION['owner'])){

        $usertype = 'owner';
        
    }
    
    // formamos la query para eliminar el usuario

    if($usertype == 'traveller') {

        $id = isset($_SESSION['traveller']['ID']) ? $_SESSION['traveller']['ID'] : false; // coge el id del usuario actual
        $query= "DELETE FROM Travellers WHERE ID = '$id'";

    }

    if($usertype == 'owner') {

        $id = isset($_SESSION['owner']['ID']) ? $_SESSION['owner']['ID'] : false; // coge el id del usuario actual
        $query= "DELETE FROM Owners WHERE ID = '$id'";

    }
    
    
    if (mysqli_query($con, $query)) {

        echo "div class='fila-info-owners'>Se ha eliminado correctamente</div>";
        unset($_SESSION['traveller']);
        unset($_SESSION['owner']);
        
    } else{

        echo "<div class='fila-info-owners'>Se ha producido un error, ¿ha introducido los datos correctamente?</div>";

    }

    $con -> close();

}

// EDITAR USUARIOS

function editUser($dni, $direccion, $cp, $ciudad, $pais, $email, $contrasena, $telefono) { // hay que pasarle las variables nombre y contraseña para identificar al usuario que vamos a eliminar

    include "Model/DDBB/connection.php";

    $dni = isset($_POST['dni']) ? $_POST['dni'] : false;
    $email = isset($_POST['email']) ? $_POST['email'] : false;
    $contrasena = isset($_POST['contrasena']) ? $_POST['contrasena'] : false;
    $direccion = isset($_POST['direccion']) ? $_POST['direccion'] : false;
    $cp = isset($_POST['cp']) ? $_POST['cp'] : false;
    $ciudad = isset($_POST['ciudad']) ? $_POST['ciudad'] : false;
    $pais = isset($_POST['pais']) ? $_POST['pais'] : false;
    $telefono = isset($_POST['telefono']) ? $_POST['telefono'] : false;
    
    if(isset($_SESSION['traveller'])){

        $usertype = 'traveller';
        
    }

    if(isset($_SESSION['owner'])){

        $usertype = 'owner';
        
    }
    
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

        echo "<div class='fila-info-owners'>Hay algun error en los datos rellenados. Por favor, compruebe que se han introducido correctamente</div>";
        var_dump($errores);

    }

    // La query se elige en función del tipo de usuario
    
    
    if($usertype == 'traveller'){

        $query= "UPDATE Travellers SET Email = '$email', Password = '$contrasena_segura', Address = '$direccion', PC = '$cp', City = '$ciudad', Country = '$pais', Phone = '$telefono' WHERE DNI_traveller = '$dni'";
        
    }

    if($usertype == 'owner'){

        $query= "UPDATE Owners SET Email = '$email', Password = '$contrasena_segura', Address = '$direccion', PC = '$cp', City = '$ciudad', Country = '$pais', Phone = '$telefono' WHERE DNI_owner = '$dni'";
        
    }
    

    if (mysqli_query($con, $query)) {
        
        $tested = mysqli_affected_rows($con); // comprueba que se ha modificado el registro

        if($tested != 0) {
 
            echo "<div class='fila-info-owners'>Se actualizaron tus datos</hdiv";

            } else {
                
                echo "<div class='fila-info-owners'>Se ha producido un error en la consulta, ¿ha introducido su DNI correctamente?</div>";

                exit();

            }
        
    } else {
            
        echo "<div class='fila-info-owners'Se ha producido un error en la consulta, ¿ha introducido sus datos correctamente?</div>";
        var_dump($con);
    
        }

    $con -> close();

}

// ENVIAR CONTRASEÑA AL USUARIO

function forgetUser(){

    include "Model/DDBB/connection.php";

    $email = isset($_POST['email']) ? $_POST['email'] : false;
    $usertype = isset($_POST['usertype']) ? $_POST['usertype'] : false;

    if (!empty($email) && filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $email_validado = true;
    } else {
        $email_validado = false;
        echo "El campo email es inválido";
    }

    if($usertype == 'traveller'){

        $query = "SELECT Email, Name, Surname FROM Travellers WHERE Email = '$email'";
        
    }

    if($usertype == 'owner'){

        $query = "SELECT Email, Name, Surname FROM Owners WHERE Email = '$email'";

    }
    
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
            
            echo "<div class='fila-info-owners'>Se ha enviado un email a su dirección de correo electrónico</div>";
            
        } else {

            echo "<div class='fila-info-owners'>Ha habido algun error a la hora de enviarle su email. Por favor, póngase en contacto con nosotros</div>";
            
        };
        
        //var_dump(mail($fila[0], 'Confirmación de contraseña', $mensaje));

    } else {

        echo "<div class='fila-info-owners'>Esa dirección de email no ha sido registrada anteriormente con ese tipo de usuario</div>";
        
    }
}

// CAMBIAR CONTRASEÑA DEL USUARIO

function reminderUser($email, $contrasena) {

    include "Model/DDBB/connection.php";

    $email = isset($_POST['email']) ? $_POST['email'] : false;
    $contrasena = isset($_POST['contrasena']) ? $_POST['contrasena'] : false;
    $usertype = isset($_POST['usertype']) ? $_POST['usertype'] : false;

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

    if($usertype == 'traveller') {

        $query = "UPDATE Travellers SET Password = '$contrasena_segura' WHERE Email = '$email'";
        
    }

    if($usertype == 'owner') {

        $query = "UPDATE Owners SET Password = '$contrasena_segura' WHERE Email = '$email'";

    }
    

    if (mysqli_query($con, $query)) {
        
        $tested = mysqli_affected_rows($con); // comprueba que se ha modificado el registro

        if($tested != 0) {
 
            echo "<div class='fila-info-owners'>Se actualizaron tus datos</div>";

            } else {
                
                echo "<div class='fila-info-owners'>Su correo electrónico no consta en nuestra base de datos, por favor, compruebelo y vuelva a intentarlo</div>";

                exit();

            }
        
    } else {
            
        echo "<div class='fila-info-owners'Se ha producido un error en la consulta, ¿ha introducido sus datos correctamente?</div>";
    
        }

    $con -> close();

}

?>

