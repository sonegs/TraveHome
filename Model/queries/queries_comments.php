<?php


/*

***************************************************************************
************************ FUNCIONES PARA COMENTARIOS ***********************
***************************************************************************

*/

// INSERTAR COMENTARIO

function sendComment(){

    include "Model/DDBB/connection.php";
    
    //Recogemos las variables del formulario

    $valoracion = isset($_POST['estrellas']) ? $_POST['estrellas'] : false;
    $comentario = isset($_POST['comentario']) ? $_POST['comentario'] : false;
    $idTraveller = isset($_SESSION['traveller']['ID']) ? $_SESSION['traveller']['ID'] : false;
    $idHousing = isset($_POST['id-housing']) ? $_POST['id-housing'] : false;
    $idBooking = isset($_POST['id-booking']) ? $_POST['id-booking'] : false; 
    
    // Comprueba que no haya un comentario ya para esta reserva y que el estado de la reserva sea Aceptada
    $queryTest = "SELECT * FROM Comments, Booking WHERE Comments.ID_housing = $idHousing AND Comments.ID_traveller = $idTraveller
    AND Booking.ID_housing = $idHousing AND Booking.ID_traveller = $idTraveller AND Booking.State = 'Caducada'";
    $doQueryTest = mysqli_query($con, $queryTest);
    
        if ($elementos = mysqli_fetch_row($doQueryTest)) { // Si ya se ha realizado la petición

            echo "<h4 class='delete-advice'>Ya ha enviado un comentario a este alojamiento.</h4>";

        } else {

            $queryComment = "INSERT INTO Comments (Content, Assessment, ID_traveller, ID_housing) VALUES ('$comentario', '$valoracion', '$idTraveller', '$idHousing');"; //Introduce la valoración y el comentario
            $queryStatus = "UPDATE Booking SET State = 'Caducada' WHERE ID = '$idBooking'"; //Actualiza el estado de la reserva
            
            if (mysqli_query($con, $queryComment) && mysqli_query($con, $queryStatus)){

                echo "<h4 class='delete-advice'>El comentario se ha enviado</h4>";

            } else {
                
                echo "<h4 class='delete-advice'>Ha ocurrido un problema al enviar el comentario. Intentelo de nuevo más tarde</h4><br>";
                //printf("Errormessage: %s\n", $con->error);
            }

        }

    $con->close();

}

//MOSTRAR COMENTARIOS

function showComments($idHousing){

    include "Model/DDBB/connection.php";
   
        $queryComment = "SELECT Comments.ID, Comments.Assessment, Comments.Content, Travellers.Name FROM Comments, Travellers WHERE ID_housing = $idHousing AND Travellers.ID = Comments.ID_traveller";
        $doQueryComment = mysqli_query($con, $queryComment);
        
        while ($comentarios = mysqli_fetch_row($doQueryComment)) { ;//PONER AQUI EL FORMATO EN EL QEU APARECEN LOS COMENTARIOS ?>
            
            <div class="comentarios">
                <div class="comentarios-file">
                    <div class="comentarios-up">
                        <div class="comentarios-assessment">
                            Valoración: 
                            <div class="comentarios-assessment-styles">
                                <?php echo '<div class="stars">'; 
                                for($i = 1; $i <= $comentarios[1]; $i++){
                                    echo '★';
                                }
                                echo '</div>';
                                ?>   
                            </div>
                        </div>
                        <div class="comentarios-name">
                            Viajero:
                            <div class="comentarios-name-styles">
                                <?php echo $comentarios[3] ?>
                            </div>
                        </div>
                    </div>
                    <div class="comentarios-down">
                        <div class="comentarios-content">
                            <?php echo $comentarios[2] ?>
                        </div>
                    </div>
                </div>
            </div>
            <input type="number" name="assessment" value="<?php echo $comentarios[1]?>" class="input_form" hidden>
            <input type="text" name="content" value="<?php echo $comentarios[3]?>" class="input_form" hidden>
            <input type="text" name="traveller" value="<?php echo $comentarios[2]?>" class="input_form" hidden>
        <?php }

            $con->close();
        
}

?>