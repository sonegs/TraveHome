<?php 
        include "Model/queries/queries_bookings.php";

        // Al recibir los valores de otro formulario y volver a enviarlos por POST, tengo que guardar los resultados
        // de las consultas del formulario anterior en input hiddens para volver a utilizarlas ahora
        
        if(isset($_POST['submit'])){
            
            if(!empty($_POST['trip-start']) && !empty($_POST['trip-end'])){
                
                sendMessage($_POST['IDowner'], $_POST['name-img']); 

            }else {

                echo "<h4>Añada la fecha de entrada y la fecha de salida del apartamento</h4>";

                } 

        }
?>

<section class="principalBooking">
    <form class="info-files" method="POST" action="index.php?tr=%208">
            
            <div class="title-book"><?php echo $_POST['name']?></div>
            <div class="subtitle-book"><?php echo $_POST['direccion'].' - '.$_POST['ciudad'].', '.$_POST['pais']?></div>
            <div class="imagen-book"><img name="name-img" src="View/uploads/<?php echo $_POST['name-img']?>"></div>
            <div class="description-book"><?php echo $_POST['description']?></div>
            
            
            Valoracion<h4 class="number"><?php echo $_POST['assessment']?></h4>
            Comentario<h4 class="text"><?php echo $_POST['content']?></h4>
            ID del viajero<h4 class="number"><?php echo $_POST['ID_traveller']?></h4>

            <?php

                // Aquí aparecen los comentarios de otros viajeros
                include "Model/queries/queries_comments.php";
                showComments($_POST['idHouse']); 

            ?>

            <h5>Fecha de entrada</h5><input type="date" id="start" name="trip-start"
            value=""
            ><h5>Fecha de salida</h5>
            <input type="date" id="end" name="trip-end"
            value=""><br>
            <p id="demo"></p>
            <input type="number" name="IDowner" value="<?php echo $_POST['idOwner']?>" class="input_form" hidden>
            <input type="text" name="name-img" value="<?php echo $_POST['name-img']?>" class="input_form" hidden>
            <input type="submit" name="submit" value="Enviar" class="input_form" id="checkdates">
            <input type="reset" name="reset" id="fechas" value="Cancelar" class="input_form">
    </form>
</section>