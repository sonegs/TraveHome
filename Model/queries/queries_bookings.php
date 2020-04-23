<?php


/*

***************************************************************************
************************ FUNCIONES PARA RESERVAR **************************
***************************************************************************

*/

// VER RESERVAS

function showBooking(){
    
    include "Model/DDBB/connection.php";

    if(isset($_SESSION['traveller'])){ // la consulta para ver las reservas si es usuario traveller
        $idTraveller = $_SESSION['traveller']['ID'];
        $query = "SELECT Housing.Name_home, Housing.Address, Housing.City, Housing.Country, Booking.checkin, 
        Booking.checkout, Owners.Email, Housing.Name_img, Booking.State, Booking.ID, Booking.ID_housing,
        Booking.ID_traveller, Booking.ID_owner, Owners.Name, Owners.Surname FROM Booking, Housing, Owners WHERE 
        Booking.ID_traveller = '$idTraveller' AND Booking.ID_owner = Owners.ID AND Booking.ID_housing = Housing.ID ORDER BY Booking.checkin DESC";
        
    }

    if(isset($_SESSION['owner'])){ // la consulta para ver las reservas si es usuario owner
        
        $idOwner = $_SESSION['owner']['ID'];
        $query = "SELECT Housing.Name_home, Housing.Address, Housing.City, Housing.Country, Booking.checkin, 
        Booking.checkout, Travellers.Email, Housing.Name_img, Booking.State, Booking.ID, Booking.ID_housing,
        Booking.ID_traveller, Booking.ID_owner, Travellers.Name, Travellers.Surname FROM Booking, Housing, Travellers WHERE 
        Booking.ID_owner = '$idOwner' AND Booking.ID_traveller = Travellers.ID AND Booking.ID_housing = Housing.ID ORDER BY Booking.checkin DESC";

    }

    $doQuery = mysqli_query($con, $query);
    
        ?>
        <div class="booking-list">
        <?php


        while ($elementos = mysqli_fetch_row($doQuery)) { //muestra las reservas que han hecho.
            //este codigo une los distintos códigos de la BBDD para añadir seguridad a las reservas y para acceder a ellas y modificarlas
            $checkinFormated = $elementos[4][8].$elementos[4][9].'-'.$elementos[4][5].$elementos[4][6].'-'.
            $elementos[4][0].$elementos[4][1].$elementos[4][2].$elementos[4][3];

            $checkoutFormated = $elementos[5][8].$elementos[5][9].'-'.$elementos[5][5].$elementos[5][6].'-'.
            $elementos[5][0].$elementos[5][1].$elementos[5][2].$elementos[5][3];
?>
            
            <div class="house-file">
                <div class="house-file-zone">
                    <div class="image-listbook">
                        <img class="listbooking-img" src="View/uploads/<?php echo $elementos[7]?>">
                    </div>
                
                    <div class="info-book">
                        <div class="name-house-book">
                            <?php echo $elementos[0]?>
                        </div>
                        <div class="details-book">
                            <div class="address-house">
                                <?php echo $elementos[1]?>
                            </div>
                            <div class="description-house">
                                <?php echo "Estado: ".$elementos[8] ?>
                            </div>
                            <div class="checks-book">
                                <?php echo $checkinFormated.' - '.$checkoutFormated ?>
                            </div>
                        
            
                            <div class="options">
                            <?php 
                            
                                if($elementos[8] == 'Pendiente' || $elementos[8] == 'Aceptada'){ 
                                    
                                    if(isset($_SESSION['owner'])){ //EL ENVIO DE LOS USUARIOS PROPIETARIOS                        

                            ?>

                                        <form action="index.php?ow=%209" method="POST"> 

                                <?php } 
                                
                                    if(isset($_SESSION['traveller'])){ //EL ENVIO DE LOS USUARIOS TRAVELLERS. ESTA JUNTO PARA APROVECHAR CÓDIGO?>

                                        <form action="index.php?tr=%207" method="POST"> 
                                            
                                        <?php } ?>

                                            <input type="text" name="house" value="<?php echo $elementos[0]?>" class="input_form" hidden>
                                            <input type="date" name="checkin" value="<?php echo $elementos[4]?>" class="input_form" hidden>
                                            <input type="date" name="checkout" value="<?php echo $elementos[5]?>" class="input_form" hidden>
                                            <input type="text" name="email" value="<?php echo $elementos[6]?>" class="input_form" hidden>
                                            <input type="text" name="name-img" value="<?php echo $elementos[7]?>" class="input_form" hidden>
                                            <input type="text" name="state" value="<?php echo $elementos[8]?>" class="input_form" hidden>
                                            <input type="number" name="id-booking" value="<?php echo $elementos[9]?>" class="input_form" hidden>
                                            <input type="number" name="id-housing" value="<?php echo $elementos[10]?>" class="input_form" hidden>        
                                            <input type="number" name="id-traveller" value="<?php echo $elementos[11]?>" class="input_form" hidden>        
                                            <input type="number" name="id-owner" value="<?php echo $elementos[12]?>" class="input_form" hidden>        
                                            <input type="text" name="name" value="<?php echo $elementos[13]?>" class="input_form" hidden>
                                            <input type="text" name="surname" value="<?php echo $elementos[14]?>" class="input_form" hidden>
                                            <input type="submit" name="aceptar" value="Gestionar" class="users-buttons-housing">
                                            
                                        </form>
                                

                            <?php } //se cierra el formulario si el estado es pendiente o aceptada
                            
                                if(isset($_SESSION['owner'])){ //EL RESTO DE OPCIONES DE LOS USUARIOS PROPIETARIOS
                                
                                    if($elementos[8] == 'Cancelada'){ ?> 

                                        <p>El huesped canceló la reserva</p>
                                    
                                    <?php }
                                    
                                    
                                    elseif($elementos[8] == 'Expirada'){ ?> 
                                    
                                    <?php }
                                    
                                    elseif($elementos[8] == 'Rechazada') { ?>

                                        <p>Usted rechazó la reserva</p>

                                    <?php

                                    } 
                                
                                } // cierre de las opciones en owner

                                if(isset($_SESSION['traveller'])){ //EL RESTO DE OPCIONES DE LOS USUARIOS TRAVELLER

                                    if($elementos[8] == 'Caducada'){ ?> 

                                        
                            
                                <?php } 

                                    elseif($elementos[8] == 'Expirada'){

                                        ?>

                                        <form action="index.php?tr=%208" method="POST">
                                            <input type="number" name="id-booking" value="<?php echo $elementos[9]?>" class="input_form" hidden>
                                            <input type="number" name="id-housing" value="<?php echo $elementos[10]?>" class="input_form" hidden>
                                        <input type="submit" value="Valorar la estancia" class="users-buttons-housing">
                            
                                <?php } 
                                
                                    elseif($elementos[8] == 'Rechazada'){ ?> 
                                    
                                        <p>El propietario rechazó su solicitud</p>

                                <?php }
                            
                                    elseif($elementos[8] == 'Cancelada') { ?>

                                        <p>Usted canceló la reserva</p>

                                <?php

                                    }

                                } // cierre de las opciones en traveller

                                ?>
                
                                </div>
                        
                        </div>
                    </div>
                </div>
                </div>
                        
                <?php

                if (mysqli_query($con, $query)) {
                    
                } else {
        
                    echo "<h4 class='delete-advice>Se ha producido un error en la consulta</h4>";
        
                }
    
        }  // cierre del while y del if
        

} // cierre de la funcion

// PEDIR RESERVA

function sendMessage($idOwner, $nameImg) { // le pasamos los valores necesarios para insertar el comentario
    
    include "Model/DDBB/connection.php";

    // declaración de variables que cogemos del formulario y de los datos de la sesion
    
    $tripStart = $_POST['trip-start'] ? $_POST['trip-start'] : false;
    $tripEnd = $_POST['trip-end'] ? $_POST['trip-end'] : false;
    $idTraveller = $_SESSION['traveller']['ID'];
    $nombre = $_SESSION['traveller']['Name'];
    $apellidos = $_SESSION['traveller']['Surname'];
    $direccion = $_POST['direccion'];
    $ciudad = $_POST['ciudad'];
    $pais = $_POST['pais'];
    //$assessment = $_POST['assessment'];
    //$content = $_POST['content'];
    //$traveller = $_SESSION['traveller'];

    // Creamos valores para poder comparar la fecha introducida con la actual y testear los datos 
    $hoy = getDate()['year'].'-'.getDate()['mon'].'-'.getDate()['mday'];
    $today = strtotime($hoy);
    
// Como la fecha viene en formato ingles, establecemos el localismo.
setlocale(LC_ALL, 'en_US');

// Fecha en formato yyyy/mm/dd
$timestamp1 = strtotime($tripStart);
$timestamp2 = strtotime($tripEnd);

// Fecha en formato dd/mm/yyyy
$checkin = strftime("%d/%m/%Y", $timestamp1);
$checkout = strftime("%d/%m/%Y", $timestamp2);

    // query para seleccionar los datos del propietario de la vivienda

$queryMail = "SELECT Owners.Email, Owners.Name, Owners.Surname, Housing.ID, Housing.Name_home 
FROM Owners, Housing WHERE Housing.ID_owner = '$idOwner' AND Owners.ID = '$idOwner' AND Housing.Name_img = '$nameImg'";

$envioQuery = mysqli_query($con, $queryMail);

    if ($element = mysqli_fetch_row($envioQuery)) {

        $mailOwner = $element[0];
        $nameOwner = $element[1];
        $surnameOwner = $element[2];
        $idHousing = $element[3];     
        $nameHouse = $element[4];     
        
        // ESTA SENTENCIA GUARDA LA PETICION DE RESERVA EN LA BASE DE DATOS
        $queryBook = "INSERT INTO Booking (ID_housing, ID_traveller, ID_owner, Checkin, Checkout, State) VALUES ('$idHousing', '$idTraveller', '$idOwner', '$tripStart', '$tripEnd', 'Pendiente');";

        // ESTA SENTENCIA COMPRUEBA QUE LA PETICION DE RESERVA NO SE HAYA HECHO ANTERIORMENTE
        
        $queryTest = "SELECT * FROM Booking WHERE ID_housing = $idHousing AND ID_traveller = $idTraveller AND ID_owner = $idOwner AND (State = 'Pendiente' OR State = 'Aceptada');";
        $doQueryTest = mysqli_query($con, $queryTest);

        if ($timestamp1 >= $today && $timestamp2 > $timestamp1){ //se comprueban las fechas del checkin y checkout

        if (mysqli_fetch_row($doQueryTest) > 0) { // Si ya se ha realizado la petición

            echo "<h4 class='delete-advice'>Ya ha enviado una solicitud para reservar esta vivienda. Por favor, espere a la respuesta del propietario </h4>";

        } else {  // Si no se ha realizado antes, se envia el email y se almacena en la BBDD

            if(mysqli_query($con, $queryBook)){
            
                // esta query se hace para seleccionar el ID de la reserva que se acaba de realizar y asi poder formar un código de seguridad
                $queryID = "SELECT ID FROM Booking WHERE ID_housing = $idHousing AND ID_traveller = $idTraveller AND ID_owner = $idOwner AND State = 'Pendiente';";
                
                $envioQueryID = mysqli_query($con, $queryID);
                
                if ($takeIDBooking = mysqli_fetch_row($envioQueryID)) {
        
                    $idBooking = $takeIDBooking[0];
                    
                    // MENSAJE QUE SE ENVIA AL PROPIETARIO DE LA VIVIENDA
                    $mensaje = "Hola $nameOwner $surnameOwner, 

                    El usuario $nombre $apellidos ha solicitado alojarse en su vivienda $nameHouse desde el $checkin hasta el $checkout.

                    Si desea aceptar a este huesped, por favor, gestione la reserva a través de nuestra página web.

                    Un saludo
                    
                    El equipo de TraveHome";
                    
                    //echo $mensaje; 
                
                }

                if(mail($mailOwner, 'Solicitud de alojamiento', $mensaje)){ //se envia el email al propietario de la vivienda

                    echo "<h4 class='delete-advice'>Hemos enviado un email al propietario de la vivienda. Se pondrá en contacto con usted en los próximos días</h4>";

                } else {

                    echo "<h4 class='delete-advice'>Ha habido un error al enviar el email. Por favor, intentelo de nuevo más tarde</h4>";

                }

            } else {
                
                echo "<h4 class='delete-advice'>Ha ocurrido un error con su solicitud. por favor, intentelo de nuevo más tarde </h4>";
                
            } 
        }
        
    } else {
        
        // Si las fechas introducidas no son válidas, se reenvia la información del propietario al formulario de reserva
                    
                echo "<h4 class='delete-advice'>Las fechas no son validas</h4>";
                
    }
    
} else {
    
            echo "<h4 class='delete-advice'>Ha ocurrido un error con la conexión a la base de datos. por favor, intentelo de nuevo más tarde </h4>";
            //printf("Errormessage: %s\n", $con->error);
}

$con -> close();

}

// ACEPTAR O RECHAZAR RESERVA

function decisionBooking($decision){

    include "Model/DDBB/connection.php";
    
    // declaración de variables que cogemos del formulario y de los datos de la sesion
    if(isset($_SESSION['owner'])){   

        $phoneOwner = $_SESSION['owner']['Phone'];
        $nameOwner = $_SESSION['owner']['Name'];
        $surnameOwner = $_SESSION['owner']['Surname'];
        $emailOwner = $_SESSION['owner']['Email'];

    }

    $idBook = isset($_POST['id-booking']) ? $_POST['id-booking'] : false;
    $idHousing = isset($_POST['id-housing']) ? $_POST['id-housing'] : false;
    $idTraveller = isset($_POST['id-traveller']) ? $_POST['id-traveller'] : false;
    $idOwner = isset($_POST['id-owner']) ? $_POST['id-owner'] : false;
    
    
    // Consulta para obtener los datos de la reserva
    $queryDecided = "SELECT Housing.Name_home, Travellers.Email, Travellers.Phone, Travellers.Name, 
    Travellers.Surname, Booking.State,Booking.ID, Booking.checkin, Booking.checkout, Owners.Email FROM Booking, 
    Travellers, Housing, Owners WHERE Booking.ID = $idBook AND Owners.ID = $idOwner AND 
    Travellers.ID = $idTraveller AND Housing.ID = $idHousing";

    $doQueryDecided = mysqli_query($con, $queryDecided);

        if ($seleccion = mysqli_fetch_row($doQueryDecided)) { // Si ya se ha realizado la petición
            
            // Se asignan los valores de la respuesta de la BBDD en distintos valores para poder trabajar con ellos
            $nameHouse = $seleccion[0];
            $emailTraveller = $seleccion[1];
            $phoneTraveller = $seleccion[2];
            $nameTraveller = $seleccion[3];
            $surnameTraveller = $seleccion[4];
            $state = $seleccion[5];
            $id_booking = $seleccion[6];
            $tripStart = $seleccion[7];
            $tripEnd = $seleccion[8];
            $emailOwner = $seleccion[9];
    
            // Cambiamos el formato de la fecha para enviar los emails

            // Como la fecha viene en formato ingles, establecemos el localismo.
            setlocale(LC_ALL, 'en_US');

            // Fecha en formato yyyy/mm/dd
            $timestamp1 = strtotime($tripStart);
            $timestamp2 = strtotime($tripEnd);

            // Fecha en formato dd/mm/yyyy
            $checkin = strftime("%d/%m/%Y", $timestamp1);
            $checkout = strftime("%d/%m/%Y", $timestamp2);

            if($decision == 'Aceptada'){ // SI SE ACEPTA LA SOLICITUD

                // Cambiamos la consulta de reserva si es aceptada o rechazada para no poder modificar las rechazadas
                $queryChange = "UPDATE Booking SET State = '$decision' WHERE ID = '$id_booking' AND State = 'Pendiente'"; 
                $doQueryChange = mysqli_query($con, $queryChange);

                if (mysqli_query($con, $queryChange)) {

                        // MENSAJE QUE SE ENVIA AL VIAJERO QUE HA SOLICITADO LA ESTANCIA EN LA VIVIENDA
                        $mensajeTraveller = "Hola $nameTraveller $surnameTraveller, 

                        El propietario de la vivienda ha aceptado su solicitud para alojarse en su vivienda $nameHouse desde el $checkin hasta el $checkout.

                        Puede ponerse en contacto con el propietario a través de este correo electrónico $emailOwner o del siguiente número de teléfono $phoneOwner.
            
                        Si por el contrario, desea cancelar su estancia, acceda a ella iniciando sesión en nuestra web.

                        Un saludo
                
                        El equipo de TraveHome";
                
                        //echo $mensajeTraveller.'<br>'; 

                        // MENSAJE QUE SE ENVIA AL PROPIETARIO DE LA VIVIENDA
                        $mensajeOwner = "Hola $nameOwner $surnameOwner,

                        Le enviamo este email porque ha aceptado la solicitud de $nameTraveller $surnameTraveller para alojarse en su vivienda $nameHouse desde el $checkin hasta el $checkout.

                        Puede ponerse en contacto con su huesped a través de este correo electrónico $emailTraveller o del siguiente número de teléfono $phoneTraveller.
            
                        Si por el contrario, desea cancelar esta reserva, acceda a ella iniciando sesión en nuestra web.

                        Un saludo
                
                        El equipo de TraveHome";
                
                        //echo $mensajeOwner.'<br>'; 
            
                        if(mail($emailTraveller, 'Confirmación de estancia', $mensajeTraveller) && mail($emailOwner, 'Confirmación de alojamiento', $mensajeOwner) ){

                           
                                echo "<h4 class='delete-advice'>La solicitud ha sido aceptada. Hemos enviado un email al traveller que ha solicitado su alojamiento. Se pondrá en contacto con usted en los próximos días</h4>";
                        } else {
    
                            echo "<h4 class='delete-advice'>Ha habido un error al enviar el email. Por favor, intentelo de nuevo más tarde</h4>";
    
                        }

                    }
                     
                
            
            } // Aquí acaba el proceso si ha sido aceptada
                
            if ($decision == 'Rechazada') { // SI SE HA RECHAZADO LA SOLICITUD

                if(isset($_SESSION['traveller'])){

                    $decision = 'Cancelada'; 
                    //de esta forma sabemos si quien ha cancelado la reserva es el 
                    // propietario (Rechazada) o el traveller(Cancelada)

                }

                $queryChange = "UPDATE Booking SET State = '$decision' WHERE ID = '$id_booking'";

                if (mysqli_query($con, $queryChange)) {
                
                    // MENSAJE QUE SE ENVIA AL VIAJERO QUE HA SOLICITADO LA ESTANCIA EN LA VIVIENDA
                    $mensajeTraveller = "Hola $nameTraveller $surnameTraveller,

                    El propietario de la vivienda ha rechazado su solicitud para alojarse en su vivienda $nameHouse desde el $checkin hasta el $checkout.

                    Le invitamos a que revise de nuevo los alojamientos por si pudiese encontrar otro de su interés.

                    Un saludo
                    
                    El equipo de TraveHome";
                    
                    //echo $mensajeTraveller.'<br>'; 
                    
                    if(mail($emailTraveller, 'Solicitud de alojamiento', $mensajeTraveller) && isset($_SESSION['owner'])){ //si se envia el email y la sesión es de owner

                        echo "<h4 class='delete-advice'>Hemos enviado un email de cancelación al huesped que ha solicitado su alojamiento. Gracias por utilizar los servicios de TraveHome</h4>";
        
                    } elseif(mail($emailOwner, 'Solicitud de alojamiento', $mensajeTraveller) && isset($_SESSION['traveller'])){ //si se envia el email y la sesion es de traveller

                        echo "<h4 class='delete-advice'>Se ha cancelado su estancia en $nameHouse. Gracias por utilizar los servicios de TraveHome</h4>";
        
                    } else {
        
                        echo "<h4 class='delete-advice'>Ha habido un error al enviar el email. Por favor, intentelo de nuevo más tarde</h4>";
        
                    }

                } else {

                    echo "<h4 class='delete-advice'>No se ha podido rechazar la solicitud de alojamiento</h4>";

                }

             } // Aquí acaba el proceso si ha sido rechazada

            } else{
        
                echo "<h4 class='delete-advice'>La reserva ya ha sido gestionada. Por favor, revise la bandeja de entrada de su correo electrónico para poder contactar con el usuario</h4>";
                
                //var_dump($queryDecided).'<br>';
                //echo $queryDecided;
            }

    $con -> close();

} // Fin de la función

?>