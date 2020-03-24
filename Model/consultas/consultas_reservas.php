<?php


/*

***************************************************************************
************************ FUNCIONES PARA RESERVAR **************************
***************************************************************************

*/

function mostrarReservas(){ //CAMBIAR ESTO PARA QUE PONGA LOS DATOS DE LA RESERVA
    
    $idTraveller = $_SESSION['traveller']['ID'];
    
    include "Model/DDBB/conexion.php";

    $query = "SELECT Housing.Name_home, Housing.Address, Housing.City, Housing.Country, Booking.checkin, 
    Booking.checkout, Owners.Email, Housing.Name_img, Booking.State, Booking.ID, Booking.ID_housing,
    Booking.ID_traveller, Booking.ID_owner FROM Booking, Housing, Owners WHERE 
    Booking.ID_traveller = '$idTraveller' AND Booking.ID_owner = Owners.ID AND Booking.ID_housing = Housing.ID";
    $doQuery = mysqli_query($con, $query);
    
        while ($elementos = mysqli_fetch_row($doQuery)) {
            $code = $elementos[9].$elementos[10].$elementos[11].$elementos[12];
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
                if ($elementos[8] == 'Pendiente' OR $elementos[8] == 'Aceptada') {?>
                <form action="index.php?tr=%209" method="POST">
                    <input type="submit" value="Anular" class="input_form">
                </form>
                <?php } else { ?>
                    <form action="index.php?tr=%2010" method="POST">
                    <p>Caducada</p>
                    <input type="submit" value="Dejar un comentario" class="input_form">
                </form>
                <?php } ?>
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

function enviarMensaje() { // le pasamos los valores necesarios para insertar el comentario

include "Model/DDBB/conexion.php";

$idOwner = $_POST['IDowner'];
$tripStart = $_POST['trip-start'];
$tripEnd = $_POST['trip-end'];
$nameImg = $_POST['name_img'];
$idTraveller = $_SESSION['traveller']['ID'];
$nombre = $_SESSION['traveller']['Name'];
$apellidos = $_SESSION['traveller']['Surname'];

// Como la fecha viene en formato ingles, establecemos el localismo.
setlocale(LC_ALL, 'en_US');

// Fecha en formato yyyy/mm/dd
$timestamp1 = strtotime($tripStart);
$timestamp2 = strtotime($tripEnd);

// Fecha en formato dd/mm/yyyy
$checkin = strftime("%d/%m/%Y", $timestamp1);
$checkout = strftime("%d/%m/%Y", $timestamp2);

// query para seleccionar los datos del propietario de la vivienda

$queryMail = "SELECT Owners.Email, Owners.Name, Owners.Surname, Housing.ID, Housing.Name_home FROM Owners, Housing WHERE Housing.ID_owner = $idOwner AND Owners.ID = $idOwner AND Housing.Name_img = '$nameImg'";

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

        if ($elementos = mysqli_fetch_row($doQueryTest)) { // Si ya se ha realizado la petición

            echo "<h4>Ya ha enviado una solicitud para reservar esta vivienda. Por favor, espere a la respuesta del propietario </h4>";

        } else {  // Si no se ha realizado antes, se envia el email y se almacena en la BBDD

            if(mysqli_query($con, $queryBook)){
            
                $queryID = "SELECT ID FROM Booking WHERE ID_housing = $idHousing AND ID_traveller = $idTraveller AND ID_owner = $idOwner AND State = 'Pendiente';";
                
                $envioQueryID = mysqli_query($con, $queryID);
                
                if ($takeIDBooking = mysqli_fetch_row($envioQueryID)) {
        
                    $idBooking = $takeIDBooking[0];
                    $code = $idBooking.$idHousing.$idTraveller.$idOwner; // este es el código que el administrador va a tener que introducir para poder gestionar la reserva y para hacer la consulta SQL
                    
                    // MENSAJE QUE SE ENVIA AL PROPIETARIO DE LA VIVIENDA
                    $mensaje = "Hola $nameOwner $surnameOwner, <br><br>

                    El usuario $nombre $apellidos ha solicitado alojarse en su vivienda $nameHouse desde el $checkin hasta el $checkout.<br><br>

                    Si desea aceptar a este huesped, por favor, pinche en el siguiente enlace. El código que debe añadir para gestionar la reserva es el $code.<br><br>
                    
                    <a href='index.php?ow=%209'>Gestionar la reserva</a><br><br>

                    Si por el contrario, prefiere denegar esta solicitud, pinche <a href='index.php?ow=%210'>aquí</a>.<br><br>

                    Un saludo<br><br>
                    
                    El equipo de TraveHome";
                    
                    echo $mensaje; 
                
                }

                if(mail($mailOwner, 'Solicitud de alojamiento', $mensaje)){

                    echo "<h4>Hemos enviado un email al propietario de la vivienda. Se pondrá en contacto con usted en los próximos días</h4>";

                } else {

                    echo "<h4>Ha habido un error al enviar el email. Por favor, intentelo de nuevo más tarde</h4>";

                }

            } else {
    
                echo "<h4>Ha ocurrido un error con su solicitud. por favor, intentelo de nuevo más tarde </h4>";
    
            } 
        }
        
    } else {
        
        echo "<h4>Ha ocurrido un error con la conexión a la base de datos. por favor, intentelo de nuevo más tarde </h4>";
        printf("Errormessage: %s\n", $con->error);

    }

$con -> close();

}

// ACEPTAR O RECHAZAR RESERVA

function gestionarReserva($decision){

    include "Model/DDBB/conexion.php";

    $code = $_POST['ids']; // a traves de este código, obtendo los IDs necesarios para hacer las consultas
    $phoneOwner = $_SESSION['owner']['Phone'];
    $nameOwner = $_SESSION['owner']['Name'];
    $surnameOwner = $_SESSION['owner']['Surname'];
    $emailOwner = $_SESSION['owner']['Email'];
    
    $idBook = $code[0].$code[1]."<br>";
    $idHousing = $code[2].$code[3]."<br>";
    $idTraveller = $code[4].$code[5]."<br>";
    $idOwner = $code[6].$code[7]."<br>";

    // Consulta para obtener los datos de la reserva
    $queryDecided = "SELECT Housing.Name_home, Users.Email, Users.Phone, Users.Name, Users.Surname, Booking.State,
     Booking.ID, Booking.checkin, Booking.checkout, Owners.Email FROM Booking, Users, Housing, Owners WHERE Booking.ID = '$idBook' 
     AND Owners.ID = '$idOwner' AND Users.ID = '$idTraveller' AND Housing.ID = '$idHousing'";
    $doQueryDecided = mysqli_query($con, $queryDecided);

        if ($seleccion = mysqli_fetch_row($doQueryDecided)) { // Si ya se ha realizado la petición
            
            // Se asignan los valores de la respuesta de la BBDD en distintos valores para poder trabajar con ellos
            $nameHouse = $seleccion[0];
            $emailUser = $seleccion[1];
            $phoneUser = $seleccion[2];
            $nameUser = $seleccion[3];
            $surnameUser = $seleccion[4];
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
                        $mensajeUser = "Hola $nameUser $surnameUser, <br><br>

                        El propietario de la vivienda ha aceptado su solicitud para alojarse en su vivienda $nameHouse desde el $checkin hasta el $checkout. El código de su reserva es $code.<br><br>

                        Puede ponerse en contacto con el propietario a través de este correo electrónico <a href='mailto:$emailOwner'>$emailOwner</a> o del siguiente número de teléfono <a href='tel:$phoneOwner'>$phoneOwner</a> <br><br>
            
                        Si por el contrario, desea cancelar su estancia, pinche <a href='index.php?tr=%209'>aquí</a>.<br><br>

                        Un saludo<br><br>
                
                        El equipo de TraveHome";
                
                        //echo $mensajeUser.'<br>'; 

                        // MENSAJE QUE SE ENVIA AL PROPIETARIO DE LA VIVIENDA
                        $mensajeOwner = "Hola $nameOwner $surnameOwner, <br><br>

                        Le enviamo este email porque ha aceptado la solicitud de $nameUser $surnameUser para alojarse en su vivienda $nameHouse desde el $checkin hasta el $checkout. El código de su reserva es $code.<br><br>

                        Puede ponerse en contacto con su huesped a través de este correo electrónico <a href='mailto:$emailUser'>$emailUser</a> o del siguiente número de teléfono <a href='tel:$phoneUser'>$phoneUser</a> <br><br>
            
                        Si por el contrario, desea cancelar esta reserva, pinche <a href='index.php?ow=%2010'>aquí</a>.<br><br>

                        Un saludo<br><br>
                
                        El equipo de TraveHome";
                
                        //echo $mensajeOwner.'<br>'; 
            
                        if(mail($emailUser, 'Confirmación de estancia', $mensajeUser) && mail($emailOwner, 'Confirmación de alojamiento', $mensajeOwner) ){

                            echo "<h4>Hemos enviado un email al huesped que ha solicitado su alojamiento. Se pondrá en contacto con usted en los próximos días</h4>";
    
                        } else {
    
                            echo "<h4>Ha habido un error al enviar el email. Por favor, intentelo de nuevo más tarde</h4>";
    
                        }

                    }
                     
                }
            
            } // Aquí acaba el proceso si ha sido aceptada
                
            if ($decision == 'Rechazada') { // SI SE HA RECHAZADO LA SOLICITUD

                $queryChange = "UPDATE Booking SET State = '$decision' WHERE ID = '$id_booking'"; 
            
                if (mysqli_query($con, $queryChange)) {
                
                    // MENSAJE QUE SE ENVIA AL VIAJERO QUE HA SOLICITADO LA ESTANCIA EN LA VIVIENDA
                    $mensajeUser = "Hola $nameUser $surnameUser, <br><br>

                    El propietario de la vivienda ha rechazado su solicitud para alojarse en su vivienda $nameHouse desde el $checkin hasta el $checkout.<br><br>

                    Le invitamos a que revise de nuevo los alojamientos por si pudiese encontrar otro de su interés.<br><br>

                    Un saludo<br><br>
                    
                    El equipo de TraveHome";
                    
                    //echo $mensajeUser.'<br>'; 
                    
                    if(mail($emailUser, 'Solicitud de alojamiento', $mensajeUser) && $_SESSION['owner']){

                        echo "<h4>Hemos enviado un email de cancelación al huesped que ha solicitado su alojamiento. Gracias por utilizar los servicios de TraveHome</h4>";
        
                    } elseif(mail($emailOwner, 'Solicitud de alojamiento', $mensajeUser) && $_SESSION['traveller']){

                        echo "<h4>Se ha cancelado su estancia en $nameHouse. Gracias por utilizar los servicios de TraveHome</h4>";
        
                    } else {
        
                        echo "<h4>Ha habido un error al enviar el email. Por favor, intentelo de nuevo más tarde</h4>";
        
                    }

                } else {

                    echo "<h4>No se ha podido rechazar la solicitud de alojamiento</h4>";

                }

             } // Aquí acaba el proceso si ha sido rechazada

            } else{
        
                echo "<h4>El código que ha introducido no es correcto, no corresponde con su usuario o ya ha sido gestionada. Por favor, revíselo e intentelo de nuevo</h4>";

            }

    $con -> close();

} // Fin de la función

?>