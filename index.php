<!DOCTYPE html>
<html>

<!-- HEAD. SE AÑADE EL TÍTULO DE LA WEB, EL CSS, JQUERY Y EL SCRIPT DEL CONTROLADOR -->

<head>
    <title>TravelHome</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="View/css/styles.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!--<script src="Controller/book.js"></script>-->
</head>

<body>

<?php

require "Model/DDBB/conexion.php";

// Cookie para que se guarde el autor de la web

if(isset($_COOKIE["Copyright"])){
	
} else{

    setcookie("Copyright", "Proyecto realizado por Miguel Cobo Martinez - 2020");
    
}

// Enlaza con el archivo HTML para mostrarlo en el navegador

session_start();
		
include "View/Mains/header.php";

	if (isset($_GET['nu'])){
								
		switch ( $_GET['nu'] ) {

		case '0':
			include "View/main.php";
			break;
		case '1':
			include "View/Mains/info.php";
			break;
		case '2':
			include "View/Mains/cities.php";
			break;
		case '3':
			include "View/Sessions/entry.html";
			break;
		case '4':
			include "View/Sessions/signup.php";
			break;
		case '5':
			include "View/Mains/contact.php";
			break;
		case '6':
			include "View/Sessions/forget.php";
			break;
		case '7':
			include "View/Sessions/reminder.php";
			break;
		default:
			include "View/main.php";
			break;
			}

		}

if(isset($_SESSION['traveller'])){
	
	if (isset($_GET['tr'])){
								
		switch ( $_GET['tr'] ) {
	
		case '0':
			include "View/main.php";
			break;
		case '1':
			include "View/Mains/info.php";
			break;
		case '2':
			include "View/Housing/housing_list.php";
			break;
		case '3':
			include "View/Housing/mybookings.php";
			break;
		case '4':
			include "View/Sessions/setting.php";
			break;
		case '5':
			include "View/Mains/contact.php";
			break;
		case '6':
			include "View/Sessions/logout.php";
			break;
		case '7':
			include "View/Sessions/delete.php";
			break;
		case '8':
			include "View/Housing/booking.php";
			break;
		case '9':
			include "View/Housing/notbook.php";
			break;
		default:
			include "View/main.php";
			break;
									
		}
	
	}
}
							
if(isset($_SESSION['owner'])){
	
	if (isset($_GET['ow'])){
								
	switch ( $_GET['ow'] ) {
	
		case '0':
			include "View/main.php";
			break;
		case '1':
			include "View/Mains/info.php";
			break;
		case '2':
			include "View/Housing/housing.php";
			break;
		case '3':
			include "View/Housing/housing_list.php";
			break;
		case '4':
			include "View/Sessions/setting.php";
			break;
		case '5':
			include "View/Mains/contact.php";
			break;
		case '6':
			include "View/Sessions/logout.php";
			break;
		case '7':
			include "View/Sessions/delete.php";
			break;
		case '8':
			include "View/Housing/housingchange.php";
			break;
		case '9':
			include "View/Housing/acceptbook.php";
			break;
		case '10':
			include "View/Housing/notbook.php";
			break;
		default:
			include "View/main.php";
			break;
									
		}
	
	}
} 		

?>

</body>
</html>

