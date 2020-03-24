<section class="main">
    <form enctype="multipart/form-data" action="" method="POST">
            <h1 class="title">¿Desea aceptar la solicitud de reserva?</h1>
            <h5>Código de la reserva</h5><input type="number" name="ids" class="input_form" required><br><br>
            <input type="radio" name="decision" value="aceptar"> Aceptar
            <input type="radio" name="decision" value="rechazar">Rechazar<br>
            <input type="submit" name="submit" value="Enviar" class="input_form">
            
            </div>
        </form>
    </section>


<?php

include "Model/consultas/consultas_reservas.php";

if(isset($_POST['submit'])) {

    $radioValue = $_POST['decision'];
    
    if(isset($_POST['decision']) && $radioValue == 'aceptar') {
        
        gestionarReserva('Aceptada');
        
    }

    if(isset($_POST['decision']) && $radioValue == 'rechazar') { 
        
        gestionarReserva('Rechazada');

        }
    }

?>