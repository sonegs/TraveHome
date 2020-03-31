<section class="main">
    <form enctype="multipart/form-data" action="" method="POST">
            <h1 class="title">¿Desea cancelar la reserva?</h1>
            
            <input type="number" name="id-booking" value="<?php echo $_POST['id-booking'] ?>" class="input_form" hidden>
            <input type="number" name="id-housing" value="<?php echo $_POST['id-housing'] ?>" class="input_form" hidden>        
            <input type="number" name="id-traveller" value="<?php echo $_POST['id-traveller'] ?>" class="input_form" hidden>        


            <input type="submit" name="submit" value="Cancelar la reserva" class="input_form">
            
            
            <?php

            if(isset($_SESSION['traveller'])){

            ?>                       
                <a href="index.php?tr=%200" class="button">Volver </a><br>
            <?php

            }

            if(isset($_SESSION['owner'])){

            ?>  
                <a href="index.php?ow=%200" class="button">Volver </a><br>
            <?php

            } 
            ?>

            </div>
        </form>
    </section>


<?php

include "Model/queries/queries_bookings.php";

if(isset($_POST['submit'])) {

        decisionBooking('Rechazada');
    
}

?>