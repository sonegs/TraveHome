<section class="mybookings">
    <form class="house-form" method="POST" action="">
        <div class="position-title-book">
            <div class="title-book"><?php echo $_POST['name']?></div>
            <div class="subtitle-book"><?php echo $_POST['direccion'].' - '.$_POST['ciudad'].', '.$_POST['pais']?></div>
        </div>
            <div class="position-imagen-book">
                <div class="imagen-book">
                    <img name="name-img" class="imagen-file" src="View/uploads/<?php echo $_POST['name-img']?>">
                </div>
            </div>
            <div class="size-description-book">
                <div class="position-description-book">
                    <div class="description-book"><?php echo $_POST['description']?></div>
                </div>
            </div>

            <?php
            // Aquí aparecen los comentarios de otros viajeros
            include "Model/queries/queries_comments.php";

            if(isset($_POST['idHouse'])){

                showComments($_POST['idHouse']); 

            } else {

                $_POST['idHouse'] = 0;
                showComments($_POST['idHouse']); 

            }
                
            ?>

            <div class="dates-names">
                <div class="checks-names">
                    Fecha de entrada
                </div>
                <div class="checks-names">
                    Fecha de salida
                </div>
            </div>
            <div class="dates">
                <div class="checks-inputs">
                    <input type="date" id="start" name="trip-start" class="checks" value="">
                </div>
                <div class="checks-inputs">
                    <input type="date" id="end" name="trip-end" class="checks" value=""><br>
                </div>
            </div>
                
        
            <input type="number" name="iDowner" value="<?php echo $_POST['idOwner']?>" class="input_form" hidden>
            <input type="text" name="name" value="<?php echo $_POST['name']?>" class="input_form" hidden>
            <input type="text" name="direccion" value="<?php echo $_POST['direccion']?>" class="input_form" hidden>
            <input type="text" name="ciudad" value="<?php echo $_POST['ciudad']?>" class="input_form" hidden>
            <input type="text" name="pais" value="<?php echo $_POST['pais']?>" class="input_form" hidden>
            <input type="text" name="description" value="<?php echo $_POST['description']?>" class="input_form" hidden>
            <input type="text" name="name-img" value="<?php echo $_POST['name-img']?>" class="input_form" hidden>
            <div class="books-buttons">
                <input type="submit" name="submit" value="Enviar" class="users-buttons" id="checkdates">
                <input type="reset" onclick="location.href='index.php?tr=01'" id="fechas" value="Volver" class="users-buttons">
            </div>
            <?php 
        include "Model/queries/queries_bookings.php";

        // Al recibir los valores de otro formulario y volver a enviarlos por POST, tengo que guardar los resultados
        // de las consultas del formulario anterior en input hiddens para volver a utilizarlas ahora
        
        if(isset($_POST['submit'])){
            
            if(!empty($_POST['trip-start']) && !empty($_POST['trip-end'])){
                
                sendMessage($_POST['iDowner'], $_POST['name-img']); 

            }else {

                echo "<h4>Añada la fecha de entrada y la fecha de salida del apartamento</h4>";

                } 

        }
?>

    </form>
</section>