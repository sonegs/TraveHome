<section class="main">
    <form enctype="multipart/form-data" action="" method="POST">
            <h1 class="title">¿Desea cancelar la reserva?</h1>
            <h5>Código de la reserva</h5><input type="number" name="ids" class="input_form" required><br><br>
            <input type="submit" name="submit" value="Cancelar la reserva" class="input_form">
            
            </div>
        </form>
    </section>


<?php

include "Model/consultas/consultas_reservas.php";

if(isset($_POST['submit'])) {


        gestionarReserva('Rechazada');
    
    }

?>