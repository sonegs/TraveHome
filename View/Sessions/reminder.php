
<section>
    <form class="form-signin" action="" method="POST" name="form_usuario">
        <h3>Escriba su dirección de correo electrónico</h3>
        <input type="email" id="inputEmail" class="form-control" name="email" placeholder="Email address" required autofocus><br>
        <h5>Nueva contraseña</h5><input type="password" name="contrasena" minlength="5" value="" class="input_form" required><br><br>
        <h5>Confirme su contraseña</h5><input type="password" name="contrasena2" minlength="5" value="" class="input_form" required><br><br>
        <input type="radio" name="usertype" value="traveller"> Soy un traveller
        <input type="radio" name="usertype" value="owner"> Soy un anfitrión<br>
        <button class="btn btn-lg btn-primary btn-block" type="submit" name="submit">Enviar</button>
        
    </form>
</section>
<?php

if(isset($_POST['submit'])){

    if(isset($_POST['contrasena'])){

        if(isset($_POST['contrasena2'])){

            if(($_POST['contrasena']) == ($_POST['contrasena2'])){
   
                include "Model/queries/queries_users.php";
                reminderUser('email', 'contrasena'); 

            } else {

                echo "<h3>No coinciden las contraseñas!!</h3>";

            }
        }
    }
}

?>