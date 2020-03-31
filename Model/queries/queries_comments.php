<?php


/*

***************************************************************************
************************ FUNCIONES PARA COMENTARIOS ***********************
***************************************************************************

*/

// INSERTAR COMENTARIO

function sendComment($idBooking, $idHousing){

    include "Model/DDBB/connection.php";

    //Recogemos las variables del formulario

    $valoracion = isset($_POST['estrellas']) ? $_POST['estrellas'] : false;
    $comentario = isset($_POST['comentario']) ? $_POST['comentario'] : false;
    $idTraveller = isset($_SESSION['traveller']['ID']) ? $_SESSION['traveller']['ID'] : false;
    // Comprueba que no haya un comentario ya para esta reserva y que el estado de la reserva sea Aceptada
    $queryTest = "SELECT * FROM Comments WHERE ID_housing = $idHousing AND ID_traveller = $idTraveller AND Status = 'Aceptada'";
    $doQueryTest = mysqli_query($con, $queryTest);

        if ($elementos = mysqli_fetch_row($doQueryTest)) { // Si ya se ha realizado la petición

            echo "<h4>Ya ha enviado un comentario a este alojamiento.</h4>";

        } else {

            $queryComment = "INSERT INTO Comments (Content, Assessment, ID_traveller, ID_housing) VALUES ('$comentario', '$valoracion', '$idTraveller', '$idHousing');"; //Introduce la valoración y el comentario
            $queryStatus = "UPDATE Booking SET State = 'Caducada' WHERE ID = '$idBooking'"; //Actualiza el estado de la reserva
            
            if (mysqli_query($con, $queryComment) && mysqli_query($con, $queryStatus)){

                echo "<h4>El comentario se ha enviado</h4>";

            } else {

                echo "<h4>Ha ocurrido un problema al enviar el comentario. Intentelo de nuevo más tarde</h4><br>";
                printf("Errormessage: %s\n", $con->error);
            }

        }

    $con->close();

}

//MOSTRAR COMENTARIOS

function showComments($idHousing){

    include "Model/DDBB/connection.php";

    $queryComment = "SELECT Comments.ID, Comments.Assessment, Comments.Content, Travellers.Name FROM Comments, Travellers WHERE ID_housing = $idHousing AND Travellers.ID = Comments.ID_traveller";
    $doQueryComment = mysqli_query($con, $queryComment);
    
    while ($comentarios = mysqli_fetch_row($doQueryComment)) { //PONER AQUI EL FORMATO EN EL QEU APARECEN LOS COMENTARIOS ?>
        <td><?php echo $comentarios[3] ?></td>
        <td><?php echo $comentarios[1] ?></td>
        <td><?php echo $comentarios[2] ?></td> 
    
    <?php }

        $con->close();

}

?>