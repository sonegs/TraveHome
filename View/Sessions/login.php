<section class="principal">
    <form class="form-signin" action="" method="POST" name="form_usuario">
        <h1 class="h3 mb-3 font-weight-normal">Inicia sesión</h1><br>
        <label for="inputEmail" class="sr-only"></label>
        <input type="email" id="inputEmail" class="form-control" name="email" placeholder="Email address" required autofocus>
        <label for="inputPassword" class="sr-only"></label>
        <input type="password" id="inputPassword" class="form-control" name="contrasena" placeholder="Password" required><br>
        <input type="radio" name="usertype" value="traveller"> Soy un traveller
        <input type="radio" name="usertype" value="owner"> Soy un anfitrión<br>
        <input type="submit" name="submit" value="Iniciar sesión" class="input_form">
        <a href="index.php?nu=%200" class="button">¿No tienes una cuenta? Regístrate </a>
        <a href="index.php?nu=%201" class="button">¿Has olvidado tu contraseña?</a>
        
    </form>
</section>

<?php

if(isset($_POST['submit'])) {

    include 'Model/queries/queries_users.php';
    login();

}


?>