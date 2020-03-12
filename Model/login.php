
<?php

session_start();
require "DDBB/conexion.php";

// Recoger datos del formulario

if(isset($_POST)){
  
  $email = trim($_POST['email']);

  $contrasena = trim($_POST['contrasena']);
  
// Consulta con la bbdd para comprobar las credenciales del usuario
  
  $query = "SELECT * FROM Users WHERE email = '$email'"; 
  
  $login = mysqli_query($con, $query);
  
  if($login && mysqli_num_rows($login) > 0){ 
    
    $usuario = mysqli_fetch_assoc($login); // recoge un array con los datos de $query
    
    $verify = password_verify($contrasena, $usuario['Password']); // verificar contraseña
    
    
    if($verify == true){
      
      //var_dump($verify);
        
      $_SESSION['usuario'] = $usuario;
      
      if(isset($_SESSION['error_login'])){
        
        unset($_SESSION['error_login']);

      } else { // Si algo falla, enviar una sesion con el fallo

          $_SESSION['error_login'] = "Login incorrecto";
          
    
      }  
    } else {

      $_SESSION['error_login'] = "Login incorrecto";
      

      }
      
      
      
    }
    }

// Redirigir al index.php

  header('Location: ../index.php');


?>