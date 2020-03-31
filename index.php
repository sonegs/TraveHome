<?php

require "Model/DDBB/connection.php";

// Cookie para que se guarde el autor de la web

if(isset($_COOKIE["Copyright"])){
	
} else{

    setcookie("Copyright", "Proyecto realizado por Miguel Cobo Martinez - 2020");
    
}

include "View/Mains/base.php";

?>