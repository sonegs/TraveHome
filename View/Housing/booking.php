<section class="main">
    <form enctype="multipart/form-data" action="" method="POST">
            <h1 class="title">Enviar la reserva</h1>
            <h5>Fecha de entrada</h5><input type="date" id="start" name="trip-start"
            value="2020-01-01"
            min="2020-01-01" max="2022-12-31"><h5>Fecha de salida</h5>
            <input type="date" id="start" name="trip-end"
            value="2020-01-02"
            min="2020-01-02" max="2999-12-31">
            <input type="number" name="IDowner" value="<?php echo $_POST['IDowner']?>" class="input_form" hidden>
            <input type="text" name="name_img" value="<?php echo $_POST['name_img']?>" class="input_form" hidden>
            <input type="submit" name="submit" value="Añadir" class="input_form">
            <input type="reset" name="reset" value="Cancelar" class="input_form">
            </div>
        </form>
    </section>

    <?php
        
        include "Model/consultas/consultas_reservas.php";
        if(isset($_POST['submit'])){
            
            enviarMensaje();

        }
        
    ?>
