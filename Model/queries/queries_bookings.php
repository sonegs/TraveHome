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
        Booking.ID_traveller, Booking.ID_owner FROM Booking, Housing, Owners WHERE 
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
    
        while ($elementos = mysqli_fetch_row($doQuery)) { //muestra las reservas que han hecho.
            //este codigo une los distintos códigos de la BBDD para añadir seguridad a las reservas y para acceder a ellas y modificarlas
            $code = $elementos[9]."-".$elementos[10]."-".$elementos[11]."-".$elementos[12];
            ?>
            
            <tr>
            <td><?php echo $code ?></td>
            <td><?php echo $elementos[0] ?></td>
            <td><?php echo $elementos[1] ?></td>
            <td><?php echo $elementos[2] ?></td>
            <td><?php echo $elementos[3] ?></td>
            <td><?php echo $elementos[4] ?></td>
            <td><?php echo $elementos[5] ?></td>
            <td><?php echo $elementos[6] ?></td>
            <td> <img src="View/uploads/<?php echo $elementos[7] ?>"></td>
            <td><?php echo $elementos[8] ?></td>
            <td id="Anular">
                <?php 
                
                

                    if($elementos[8] == 'Pendiente' || $elementos[8] == 'Aceptada'){ 
                        
                        
                        if(isset($_SESSION['owner'])){ //EL ENVIO DE LOS USUARIOS PROPIETARIOS                        
                    ?>

                        <form action="index.php?ow=%2010" method="POST"> 

                        <?php } if(isset($_SESSION['traveller'])){ //EL ENVIO DE LOS USUARIOS TRAVELLERS. ESTA JUNTO PARA APROVECHAR CÓDIGO?>

                        <form action="index.php?tr=%209" method="POST"> <?php } ?>

                    <input type="text" name="name-img" value="<?php echo $elementos[7]?>" class="input_form" hidden>
                    <input type="text" name="name" value="<?php echo $elementos[13]?>" class="input_form" hidden>
                    <input type="text" name="surname" value="<?php echo $elementos[14]?>" class="input_form" hidden>
                    <input type="text" name="state" value="<?php echo $elementos[8]?>" class="input_form" hidden>
                    <input type="date" name="checkin" value="<?php echo $elementos[4]?>" class="input_form" hidden>
                    <input type="date" name="checkout" value="<?php echo $elementos[5]?>" class="input_form" hidden>
                    <input type="number" name="id-booking" value="<?php echo $elementos[9]?>" class="input_form" hidden>
                    <input type="number" name="id-housing" value="<?php echo $elementos[10]?>" class="input_form" hidden>        
                    <input type="number" name="id-traveller" value="<?php echo $elementos[11]?>" class="input_form" hidden>        
                    <input type="number" name="id-owner" value="<?php echo $elementos[12]?>" class="input_form" hidden>        
                    <input type="submit" name="aceptar" value="Gestionar" class="input_form">
                    </form>
                    

                    <?php } 
                
                if(isset($_SESSION['owner'])){ //EL RESTO DE OPCIONES DE LOS USUARIOS PROPIETARIOS
                    
                    if($elementos[8] == 'Cancelada'){ ?> 

                        <p>El huesped canceló la reserva</p>
                    
                    <?php }
                    
                    
                    elseif($elementos[8] == 'Expirada'){ ?> 
                    
                    <?php }
                    
                    elseif($elementos[8] == 'Rechazada') { ?>

                        <p>Usted rechazó la reserva</p>

                    <?php

                } } // cierre de las opciones en owner

                if(isset($_SESSION['traveller'])){ //EL RESTO DE OPCIONES DE LOS USUARIOS TRAVELLER

                        if($elementos[8] == 'Caducada'){ ?> 

                            <p>Caducada</p>
                
                    <?php } 

                        elseif($elementos[8] == 'Expirada'){
                             ?> 
                            <form action="index.php?tr=%2010" method="POST">
                            <input type="number" name="id-booking" value="<?php echo $elementos[9]?>" class="input_form" hidden>
                            <input type="number" name="id-housing" value="<?php echo $elementos[10]?>" class="input_form" hidden>
                            <input type="submit" value="Valorar la estancia" class="input_form">
                
                    <?php } 
                    
                        elseif($elementos[8] == 'Rechazada'){ ?> 
                        
                            <p>El propietario rechazó su solicitud</p>

                    <?php }
                
                        elseif($elementos[8] == 'Cancelada') { ?>

                            <p>Usted canceló la reserva</p>

                    <?php

                        }} // cierre de las opciones en traveller

                    ?>
                
            </td>
            </tr>
            
            <?php
            if (mysqli_query($con, $query)) {
                
            } else {
    
                echo "<h1>Se ha producido un error en la consulta</h1>";
    
            }
    
    }  // cierre del while y del if
        
        ?>

        </table>
                        
        <?php

        
    $con-->close();

}

// PEDIR RESERVA

function sendMessage($idOwner, $nameImg) { // le pasamos los valores necesarios para insertar el comentario
    
    include "Model/DDBB/connection.php";

    // declaración de variables que cogemos del formulario y de los datos de la sesion
    
    $tripStart = $_POST['trip-start'] ? $_POST['trip-start'] : false;
    $tripEnd = $_POST['trip-end'] ? $_POST['trip-end'] : false;
    $idTraveller = $_SESSION['traveller']['ID'];
    $nombre = $_SESSION['traveller']['Name'];
    $apellidos = $_SESSION['traveller']['Surname'];

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

            echo "<h4>Ya ha enviado una solicitud para reservar esta vivienda. Por favor, espere a la respuesta del propietario </h4>";

        } else {  // Si no se ha realizado antes, se envia el email y se almacena en la BBDD

            if(mysqli_query($con, $queryBook)){
            
                // esta query se hace para seleccionar el ID de la reserva que se acaba de realizar y asi poder formar un código de seguridad
                $queryID = "SELECT ID FROM Booking WHERE ID_housing = $idHousing AND ID_traveller = $idTraveller AND ID_owner = $idOwner AND State = 'Pendiente';";
                
                $envioQueryID = mysqli_query($con, $queryID);
                
                if ($takeIDBooking = mysqli_fetch_row($envioQueryID)) {
        
                    $idBooking = $takeIDBooking[0];
                    $code = $idBooking.'-'.$idHousing.'-'.$idTraveller.'-'.$idOwner; // este es el código que el administrador va a tener que introducir para poder gestionar la reserva y para hacer la consulta SQL
                    
                    // MENSAJE QUE SE ENVIA AL PROPIETARIO DE LA VIVIENDA
                    $mensaje = "Hola $nameOwner $surnameOwner, <br><br>

                    El usuario $nombre $apellidos ha solicitado alojarse en su vivienda $nameHouse desde el $checkin hasta el $checkout.<br><br>

                    Si desea aceptar a este huesped, por favor, pinche en el siguiente enlace. El código que debe añadir para gestionar la reserva es el $code.<br><br>
                    
                    <a href='index.php?ow=%2010'>Gestionar la reserva</a><br><br>

                    Si por el contrario, prefiere denegar esta solicitud, pinche <a href='index.php?ow=%2011'>aquí</a>.<br><br>

                    Un saludo<br><br>
                    
                    El equipo de TraveHome";
                    
                    //echo $mensaje; 
                
                }

                if(mail($mailOwner, 'Solicitud de alojamiento', $mensaje)){ //se envia el email al propietario de la vivienda

                    echo "<h4>Hemos enviado un email al propietario de la vivienda. Se pondrá en contacto con usted en los próximos días</h4>";

                } else {

                    echo "<h4>Ha habido un error al enviar el email. Por favor, intentelo de nuevo más tarde</h4>";

                }

            } else {
                
                echo "<h4>Ha ocurrido un error con su solicitud. por favor, intentelo de nuevo más tarde </h4>";
                
            } 
        }
        
    } else {
        
        
        // Si las fechas introducidas no son válidas, se reenvia la información del propietario al formulario de reserva

        ?>
        <form name="reenvio" method="POST" action="">
        <input type="number" name="idOwner" value="<?php echo $idOwner?>" class="input_form" hidden>
        <input type="text" name="name-img" value="<?php echo $nameImg?>" class="input_form" hidden>
        </form>

        <script>;
        document.reenvio.submit();</script>
        <?php

    }
    
} else {
    
            echo "<h4>Ha ocurrido un error con la conexión a la base de datos. por favor, intentelo de nuevo más tarde </h4>";
            //printf("Errormessage: %s\n", $con->error);

}

$con -> close();

}

// ACEPTAR O RECHAZAR RESERVA

function decisionBooking($decision){

    include "Model/DDBB/connection.php";
    
    // declaración de variables que cogemos del formulario y de los datos de la sesion
    $phoneOwner = $_SESSION['owner']['Phone'];
    $nameOwner = $_SESSION['owner']['Name'];
    $surnameOwner = $_SESSION['owner']['Surname'];
    $emailOwner = $_SESSION['owner']['Email'];
    
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
                
                    if ($elementos = mysqli_fetch_row($doQueryChange)) { // Si ya se ha realizado la petición

                        echo "La petición ya ha sido procesada";
                    
                    } else { //Si aún no se ha aceptado, se realiza el siguiente código

                        // MENSAJE QUE SE ENVIA AL VIAJERO QUE HA SOLICITADO LA ESTANCIA EN LA VIVIENDA
                        $mensajeTraveller = "Hola $nameTraveller $surnameTraveller, <br><br>

                        El propietario de la vivienda ha aceptado su solicitud para alojarse en su vivienda $nameHouse desde el $checkin hasta el $checkout.<br><br>

                        Puede ponerse en contacto con el propietario a través de este correo electrónico <a href='mailto:$emailOwner'>$emailOwner</a> o del siguiente número de teléfono <a href='tel:$phoneOwner'>$phoneOwner</a> <br><br>
            
                        Si por el contrario, desea cancelar su estancia, pinche <a href='index.php?tr=%209'>aquí</a>.<br><br>

                        Un saludo<br><br>
                
                        El equipo de TraveHome";
                
                        //echo $mensajeTraveller.'<br>'; 

                        // MENSAJE QUE SE ENVIA AL PROPIETARIO DE LA VIVIENDA
                        $mensajeOwner = "Hola $nameOwner $surnameOwner, <br><br>

                        Le enviamo este email porque ha aceptado la solicitud de $nameTraveller $surnameTraveller para alojarse en su vivienda $nameHouse desde el $checkin hasta el $checkout.<br><br>

                        Puede ponerse en contacto con su huesped a través de este correo electrónico <a href='mailto:$emailTraveller'>$emailTraveller</a> o del siguiente número de teléfono <a href='tel:$phoneTraveller'>$phoneTraveller</a> <br><br>
            
                        Si por el contrario, desea cancelar esta reserva, pinche <a href='index.php?ow=%2011'>aquí</a>.<br><br>

                        Un saludo<br><br>
                
                        El equipo de TraveHome";
                
                        //echo $mensajeOwner.'<br>'; 
            
                        if(mail($emailTraveller, 'Confirmación de estancia', $mensajeTraveller) && mail($emailOwner, 'Confirmación de alojamiento', $mensajeOwner) ){

                            echo "<h4>La solicitud ha sido aceptada. Hemos enviado un email al traveller que ha solicitado su alojamiento. Se pondrá en contacto con usted en los próximos días</h4>";
    
                        } else {
    
                            echo "<h4>Ha habido un error al enviar el email. Por favor, intentelo de nuevo más tarde</h4>";
    
                        }

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
                    $mensajeTraveller = "Hola $nameTraveller $surnameTraveller, <br><br>

                    El propietario de la vivienda ha rechazado su solicitud para alojarse en su vivienda $nameHouse desde el $checkin hasta el $checkout.<br><br>

                    Le invitamos a que revise de nuevo los alojamientos por si pudiese encontrar otro de su interés.<br><br>

                    Un saludo<br><br>
                    
                    El equipo de TraveHome";
                    
                    echo $mensajeTraveller.'<br>'; 
                    
                    if(mail($emailTraveller, 'Solicitud de alojamiento', $mensajeTraveller) && $_SESSION['owner']){ //si se envia el email y la sesión es de owner

                        echo "<h4>Hemos enviado un email de cancelación al huesped que ha solicitado su alojamiento. Gracias por utilizar los servicios de TraveHome</h4>";
        
                    } elseif(mail($emailOwner, 'Solicitud de alojamiento', $mensajeTraveller) && $_SESSION['traveller']){ //si se envia el email y la sesion es de traveller

                        echo "<h4>Se ha cancelado su estancia en $nameHouse. Gracias por utilizar los servicios de TraveHome</h4>";
        
                    } else {
        
                        echo "<h4>Ha habido un error al enviar el email. Por favor, intentelo de nuevo más tarde</h4>";
        
                    }

                } else {

                    echo "<h4>No se ha podido rechazar la solicitud de alojamiento</h4>";

                }

             } // Aquí acaba el proceso si ha sido rechazada

            } else{
        
                echo "<h4>La reserva ya ha sido gestionada. Por favor, revise la bandeja de entrada de su correo electrónico para poder contactar con el usuario</h4>";
                //var_dump($queryDecided).'<br>';
                //echo $queryDecided;
            }

    $con -> close();

} // Fin de la función

?>