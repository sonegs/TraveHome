<!DOCTYPE html>
<html>

<!-- HEAD. SE AÑADE EL TÍTULO DE LA WEB, EL CSS, JQUERY Y EL SCRIPT DEL CONTROLADOR -->

<head>
    <title>TravelHome</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="View/css/styles.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!----<script src="Controller/aplicarColor.js"></script>-->
</head>

<body>

<?php

require "Model/DDBB/conexion.php";

// Cookie para que se guarde el autor de la web

if(isset($_COOKIE["Copyright"])){

} else{

    setcookie("Copyright", "Prueba realizada por Miguel Cobo Martinez - 2020");
    
}

// Enlaza con el archivo HTML para mostrarlo en el navegador

			
				session_start();
				if(isset($_SESSION['usuario'])):

						include "View/header.php";

						if (isset($_GET['op'])){
							
						switch ( $_GET['op'] ) {

							case '0':
								include "View/main.php";
								break;
							case '1':
								include "View/info.php";
								break;
							case '2':
								include "View/cities.php";
								break;
							case '3':
								include "View/housing.php";
								break;
							case '4':
								include "View/contact.php";
								break;
							default:
								include "main.php";
								break;
								
						}

						}


						elseif (isset($_GET['us'])){
							
							include "form_usuarios/cab_usuarios.php";

							switch ( $_GET['us'] ) {

								case '0':
								include "form_usuarios/list_usuarios.php";
									break;
								case '1':
								include "form_usuarios/insertar_u.php";
									break;
								case '2':
								include "form_usuarios/editar_u.php";
									break;
								case '3':
								include "form_usuarios/eliminar_u.php";
									break;
								default:
								include "form_usuarios/list_usuarios.php";
									break;
									
							}

						}

						elseif (isset($_GET['no'])){
							
							include "form_noticias/cab_noticias.php";

							switch ( $_GET['no'] ) {

								case '0':
								include "form_noticias/list_noticias.php";
									break;
								case '1':
								include "form_noticias/insertar_n.php";
									break;
								case '2':
								include "form_noticias/editar_n.php";
									break;
								case '3':
								include "form_noticias/eliminar_n.php";
									break;
								
							}

						}
						
						
	
					endif; 

					include "Model/funciones_db.php";
					
						if(!isset($_SESSION['usuario'])):
							
							include "View/login.html";

					endif; 
                    ?>
    </body>
</html>

