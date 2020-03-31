<?php

include "Model/queries/queries_bookings.php";
$checkinFormated = $_POST['checkin'][8].$_POST['checkin'][9].'-'.$_POST['checkin'][5].$_POST['checkin'][6].'-'.
$_POST['checkin'][0].$_POST['checkin'][1].$_POST['checkin'][2].$_POST['checkin'][3];

$checkoutFormated = $_POST['checkout'][8].$_POST['checkout'][9].'-'.$_POST['checkout'][5].$_POST['checkout'][6].'-'.
$_POST['checkout'][0].$_POST['checkout'][1].$_POST['checkout'][2].$_POST['checkout'][3];


if(isset($_POST['decidir'])){
    
 //si se le da a enviar y existe un estado (pendiente o aceptado)

    $radioValue = $_POST['decision'];
    
    if(isset($_POST['decision']) && $radioValue == 'aceptar') {
    
        decisionBooking('Aceptada');
        
    }

    if((isset($_POST['decision']) && $radioValue == 'rechazar')) { 
    
        decisionBooking('Rechazada');

    }

//cerramos si el estado es pendiente

} 

elseif(isset($_POST['cancelar'])){

    decisionBooking('Rechazada');

} 
else{

?>

<section class="main">
    <form action="" method="POST">
            <h1 class="title">Reserva de su vivienda</h1>
            
            <img name="name-img" src="View/uploads/<?php echo $_POST['name-img']?>">
            <h4 class="text"><?php echo $_POST['description']?></h4>
            <p>Fecha de entrada: <?php echo $checkinFormated?></p>
            <p>Fecha de salida: <?php echo $checkoutFormated?></p>
            
            <?php

            if(isset($_SESSION['traveller'])){
                
            }

            if(isset($_SESSION['owner'])){
            ?>  
                <p>Viajero: <?php echo $_POST['name'].' '.$_POST['surname']?></p>
            <?php

            } 
            ?>
            <input type="number" name="id-booking" value="<?php echo $_POST['id-booking'] ?>" class="input_form" hidden>
            <input type="number" name="id-housing" value="<?php echo $_POST['id-housing'] ?>" class="input_form" hidden>        
            <input type="number" name="id-traveller" value="<?php echo $_POST['id-traveller'] ?>" class="input_form" hidden> 
            <input type="number" name="id-owner" value="<?php echo $_POST['id-owner'] ?>" class="input_form" hidden> 

<?php

    if($_POST['state'] == 'Pendiente') { ?>

            <input type="radio" name="decision" value="aceptar"> Aceptar
            <input type="radio" name="decision" value="rechazar">Rechazar<br>
            <input type="submit" name="decidir" value="Enviar" class="input_form">
    
<?php
        
    }
    if($_POST['state'] == 'Aceptada') { ?>

            <input type="submit" name="cancelar" value="Cancelar la reserva" class="input_form">
    
<?php
   


    }


if(isset($_SESSION['traveller'])){

?>                       
    <a href="index.php?tr=%200" class="button">Volver </a><br>
<?php

}

if(isset($_SESSION['owner'])){
?>  
    <a href="index.php?ow=%204" class="button">Volver </a><br>
<?php

} 
?>
        </form>
    </section>
<?php } ?>
