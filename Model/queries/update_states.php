<?php

include "../DDBB/connection.php";

$query = "UPDATE Booking SET State = 'Expirada' WHERE State = 'Aceptada' AND checkout = CURDATE()";

if(mysqli_query($con, $query)) {

    die();

} else {

    echo "Ha ocurrido un error al contectar con la base de datos";

}

$con->close();

?>