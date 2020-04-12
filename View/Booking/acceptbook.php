
<?php
/*

include "Model/queries/queries_bookings.php"; // se cambia el formato de la fecha de la base de datos
$checkinFormated = $_POST['checkin'][8].$_POST['checkin'][9].'-'.$_POST['checkin'][5].$_POST['checkin'][6].'-'.
$_POST['checkin'][0].$_POST['checkin'][1].$_POST['checkin'][2].$_POST['checkin'][3];

$checkoutFormated = $_POST['checkout'][8].$_POST['checkout'][9].'-'.$_POST['checkout'][5].$_POST['checkout'][6].'-'.
$_POST['checkout'][0].$_POST['checkout'][1].$_POST['checkout'][2].$_POST['checkout'][3];

?>
<section class="principal-all">
    <form class="house-form" method="POST" action="">
        <div class="position-title-choose">
            <div class="title-book"><?php echo $_POST['house']?></div>
        </div>
            <div class="imagen-book">
                <img name="name-img" class="image-book" src="View/uploads/<?php echo $_POST['name-img']?>">
            </div>
            <p class="traveller-name">
                <?php

                if(isset($_SESSION['traveller'])){
                    echo "Propietario: ".$_POST['name'].' '.$_POST['surname'].'<br>';
                }

                if(isset($_SESSION['owner'])){

                    echo "Viajero: ".$_POST['name'].' '.$_POST['surname'].'<br>';

                }

                echo "Email: ".$_POST['email'];

                ?>
            </p>
            <div class="show-checks">
                <div class="background-show-checks">
                    <div class="title-show-checks">
                        <div class="check-names">
                            Fecha de entrada
                        </div>
                        <div class="check-names">
                            Fecha de salida
                        </div>
                    </div>
                    <div class="title-show-checks">
                        <div class="check-dates">
                            <?php echo $checkinFormated?>
                        </div>
                        <div class="check-dates">
                            <?php echo $checkoutFormated?>
                        </div>
                    </div>
                </div>
            </div>

             
                
                <input type="number" name="id-booking" value="<?php echo $_POST['id-booking'] ?>" class="input_form" hidden>
                <input type="number" name="id-housing" value="<?php echo $_POST['id-housing'] ?>" class="input_form" hidden>        
                <input type="number" name="id-traveller" value="<?php echo $_POST['id-traveller'] ?>" class="input_form" hidden> 
                <input type="number" name="id-owner" value="<?php echo $_POST['id-owner'] ?>" class="input_form" hidden> 

                <?php

            

            if($_POST['state'] == 'Pendiente') { ?>

                <div class="select-user">
                    <input type="radio" name="decision" value="aceptar" class="radio-signup"> Aceptar
                    <input type="radio" name="decision" value="rechazar" class="radio-signup">Rechazar<br>
                </div>
                    
                <div class="books-buttons">
                    <input type="submit" name="decidir" value="Enviar" class="users-buttons">
            
                <?php
            }
            if($_POST['state'] == 'Aceptada') { ?>

                <input type="submit" name="cancelar" value="Cancelar la reserva" class="users-buttons">
    
                    <?php
            }

            if(isset($_SESSION['traveller'])){

            ?>                       
                <a href="index.php?tr=%202" class="goback-button">Volver </a><br>

            <?php

            }

            if(isset($_SESSION['owner'])){

            ?>  

                <a href="index.php?ow=%203" class="goback-button">Volver </a><br>

            <?php

            }

         ?>
                    
                </div>

            <?php

        if(isset($_SESSION['owner'])){

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

            if(isset($_POST['cancelar'])){

                decisionBooking('Rechazada');

            }

        }

        if(isset($_SESSION['traveller'])){

            if(isset($_POST['cancelar'])){

                decisionBooking('Rechazada');

            }
        
        }


            ?>

                </form>
            </section>



*/

//<?php 

include "Model/queries/queries_bookings.php";
$checkinFormated = $_POST['checkin'][8].$_POST['checkin'][9].'-'.$_POST['checkin'][5].$_POST['checkin'][6].'-'.
$_POST['checkin'][0].$_POST['checkin'][1].$_POST['checkin'][2].$_POST['checkin'][3];

$checkoutFormated = $_POST['checkout'][8].$_POST['checkout'][9].'-'.$_POST['checkout'][5].$_POST['checkout'][6].'-'.
$_POST['checkout'][0].$_POST['checkout'][1].$_POST['checkout'][2].$_POST['checkout'][3];

?>

<section class="principal-house-form">
    <form class="house-form" method="POST" action="" id="decision-booking">
        <div class="position-title-choose">
            <div class="title-book"><?php echo $_POST['house']?></div>
        </div>
            <div class="imagen-book">
                <img name="name-img" class="image-book" src="View/uploads/<?php echo $_POST['name-img']?>">
                
                </div>
                <p class="traveller-name">
                <?php

                if(isset($_SESSION['traveller'])){
                    echo "Propietario: ".$_POST['name'].' '.$_POST['surname'].'<br>';
                }

                if(isset($_SESSION['owner'])){

                    echo "Viajero: ".$_POST['name'].' '.$_POST['surname'].'<br>';

                }

                echo "Email: ".$_POST['email'];

                ?>
                </p>
                <div class="show-checks">
                    <div class="background-show-checks">
                        <div class="title-show-checks">
                            <div class="check-names">
                                Fecha de entrada
                            </div>
                            <div class="check-names">
                                Fecha de salida
                            </div>
                        </div>
                        <div class="title-show-checks">
                            <div class="check-dates">
                                <?php echo $checkinFormated?>
                            </div>
                            <div class="check-dates">
                                <?php echo $checkoutFormated?>
                            </div>
                        </div>
                    </div>
                </div>
     
            <input type="number" name="id-booking" value="<?php echo $_POST['id-booking'] ?>" class="input_form" hidden>
            <input type="number" name="id-housing" value="<?php echo $_POST['id-housing'] ?>" class="input_form" hidden>        
            <input type="number" name="id-traveller" value="<?php echo $_POST['id-traveller'] ?>" class="input_form" hidden> 
            <input type="number" name="id-owner" value="<?php echo $_POST['id-owner'] ?>" class="input_form" hidden> 
            <input type="text" name="house" value="<?php echo $_POST['house'] ?>" class="input_form" hidden> 
            <input type="text" name="name-img" value="<?php echo $_POST['name-img'] ?>" class="input_form" hidden> 
            <input type="text" name="name" value="<?php echo $_POST['name'] ?>" class="input_form" hidden> 
            <input type="text" name="surname" value="<?php echo $_POST['surname'] ?>" class="input_form" hidden> 
            <input type="text" name="email" value="<?php echo $_POST['email'] ?>" class="input_form" hidden> 
            <input type="date" name="checkin" value="<?php echo $_POST['checkin'] ?>" class="input_form" hidden> 
            <input type="date" name="checkout" value="<?php echo $_POST['checkout'] ?>" class="input_form" hidden> 

<?php

    if($_POST['state'] == 'Pendiente') { ?>
<?php
     if(isset($_SESSION['owner'])){ ?>
        <div class="select-user">
            <input type="radio" name="decision" value="aceptar" class="radio-signup"> Aceptar
            <input type="radio" name="decision" value="rechazar" class="radio-signup">Rechazar<br>
        </div>
        <div class="books-buttons">
                <input type="submit" name="decidir" value="Enviar" class="users-buttons">
     <?php }
     if(isset($_SESSION['traveller'])){ ?> 
            
            <input type="submit" name="cancelar" value="Cancelar petición" class="users-buttons">
    
<?php
        }

    }

    if($_POST['state'] == 'Aceptada') { ?>

            <input type="submit" name="cancelar" value="Cancelar la reserva" class="users-buttons">
    
<?php
   
    }


if(isset($_SESSION['traveller'])){

?>                       
    <a href="index.php?tr=%202" class="goback-button">Volver </a><br>
<?php

}

if(isset($_SESSION['owner'])){
?>  
    <a href="index.php?ow=%203" class="goback-button">Volver </a><br>
<?php

} 
?>

        </div>

        <?php
        
if(isset($_SESSION['owner'])){

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


}


if(isset($_POST['cancelar'])){

    decisionBooking('Rechazada');

}

        
        ?>
    </form>
    
</section>

