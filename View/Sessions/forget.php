<section>
    <form class="form-signin" action="" method="POST" name="form_usuario">
        <h3>Escriba su dirección de correo electrónico</h3>
        <input type="email" id="inputEmail" class="form-control" name="email" placeholder="Email address" required autofocus><br>
        <input type="radio" name="usertype" value="traveller"> Soy un traveller
        <input type="radio" name="usertype" value="owner"> Soy un anfitrión<br>
        <button class="btn btn-lg btn-primary btn-block" type="submit" name="submit">Enviar</button>
        <a href="index.php" class="button">Volver</a>
    </form>
</section>

<?php
                
    if(isset($_POST['submit'])){

            include "Model/queries/queries_users.php";
            forgetUser(); 

    }

?>