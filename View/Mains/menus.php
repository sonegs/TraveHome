<?php


		
include "View/Mains/header.php";

if(isset($_COOKIE["Copyright"])){
	
} else{

    include "View/Mains/cookiesaccept.php";
    
}

//si no hay usuario registrado:

	if (isset($_GET['nu'])){
								
		switch ( $_GET['nu'] ) {

		case '0':
// en vez de con include o con header, se hace la redirección con javascript para que funcione al subirlo al hosting
// al hacerlo con PHP, no funciona la redirección en el hosting
			echo"<script>window.location='index.php'</script>;"; 
			break;
		case '1':
			echo"<script>window.location='index.php#ciudades'</script>;";
			break;
		case '2':
			include "View/Sessions/login.php";
			break;
		case '3':
			include "View/Sessions/signup.php";
			break;
		case '4':
			include "View/Sessions/forget.php";
			break;
		default:
			echo"<script>window.location='index.php'</script>;"; 
			break;
			}
		}
			
//si el usuario registrado es de tipo traveller
elseif(isset($_SESSION['traveller'])){
	
	if (isset($_GET['tr'])){
								
		switch ( $_GET['tr'] ) {
	
		case '0':
			include "View/Mains/main.php";
			break;
		case '1':
			include "View/Housing/housing_list.php";
			break;
		case '2':
			include "View/Booking/mybookings.php";
			break;
		case '3':
			include "View/Sessions/setting.php";
			break;
		case '4':
		include "View/Sessions/logout.php";
			break;
		case '5':
			include "View/Sessions/delete.php";
			break;
		case '6':
			include "View/Booking/booking.php";
			break;
		case '7':
			include "View/Booking/acceptbook.php";
			break;
		case '8':
			include "View/Booking/comments.php";
			break;
		default:
			include "View/Mains/main.php";
			break;
									
		}
	
	}
}
//si el usuario registrado es de tipo owner							
elseif(isset($_SESSION['owner'])){
	
	if (isset($_GET['ow'])){
								
	switch ( $_GET['ow'] ) {
	
		case '0':
			include "View/Mains/main.php";
			break;
		case '1':
			include "View/Housing/housing.php";
			break;
		case '2':
			include "View/Housing/housing_list.php";
			break;
		case '3':
			include "View/Booking/mybookings.php";
			break;
		case '4':
			include "View/Sessions/setting.php";
			break;
		case '5':
			include "View/Sessions/logout.php";
			break;
		case '7':
			include "View/Sessions/delete.php";
			break;
		case '8':
			include "View/Housing/housingchange.php";
			break;
		case '9':
			include "View/Booking/acceptbook.php";
			break;
		case '10':
			include "View/Housing/deletehousing.php";
			break;
		default:
			include "View/Mains/main.php";
			break;
									
		}
	
	}
} else {

	include "View/Mains/main.php";
	include "View/Mains/info.php";
	include "View/Mains/info2.php";
	include "View/Mains/cities.php";
	include "View/Mains/contact.php";
	
}		

?>
