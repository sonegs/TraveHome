
<?php

session_start();
require "DDBB/conexion.php";

// Recoger datos del formulario

if(isset($_POST)){
  
  $email = trim($_POST['email']);

  $contrasena = trim($_POST['contrasena']);
  
  $usertype = "";
    
    if(isset($_POST['usertype'])){

        $usertype = $_POST['usertype'];

        if($usertype == 'traveller') {

        // Consulta con la bbdd para comprobar las credenciales del usuario
  
            $query = "SELECT * FROM Users WHERE email = '$email'";
  
        }
        
        if ($usertype == 'owner') {

            $query = "SELECT * FROM Owners WHERE email = '$email'";

        }
  
        $login = mysqli_query($con, $query);
  
        if($login && mysqli_num_rows($login) > 0) { 
    
            $usuario = mysqli_fetch_assoc($login); // recoge un array con los datos de $query
    
            $verify = password_verify($contrasena, $usuario['Password']); // verificar contraseña
    
            
            if($verify == true){
      
              //var_dump($verify);
              
              if($usertype == 'traveller') {

                  $_SESSION['traveller'] = $usuario;

              } 
              
              
              if($usertype == 'owner') {
                
                  $_SESSION['owner'] = $usuario;

              } 
              
              if(isset($_SESSION['error_login'])){
        
                unset($_SESSION['error_login']);

              } else { // Si algo falla, enviar una sesion con el fallo

                $_SESSION['error_login'] = "Login incorrecto";
          
                }

              }
            
            }
            
      
          } else {

            echo "<h3>Por favor, seleccione si es un usuario traveller o un usuario owner</h3>";

          }

        }

        else {

          $usertype = "";

          }


        // Redirigir al index.php

        header('Location: ../index.php');


?>