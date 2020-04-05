<section class="principalLogin" id="loginzone">
    


<?php

if(isset($_POST['submit'])) {

    include 'Model/queries/queries_users.php';
    login();

}
?>
    <form class="form" action="" method="POST" name="form_usuario">
        <div class="info-title-login">Inicia sesión</div>
            <div class="fila-form-login">
                <div class="col-12">
                    <div class="login-form">
                        <label for="inputEmail"></label>
                        <input type="email" id="inputEmail" class="login-form-styles" name="email" placeholder="Email address" required>
                    </div>
                </div>
            </div>
            <div class="fila-form-login">
                <div class="col-12">
                    <div class="login-form">
                        <label for="inputPassword"></label>
                        <input type="password" id="inputPassword" class="login-form-styles" name="contrasena" placeholder="Password" required>
                    </div>
                </div>
            </div>
            <div class="fila-info-login">
                <div class="col-6">
                    <div class="info-position-img">
                        <img class="info-login-img" src="View/src/bag-icon.png" alt="viajero">
                    </div>
                </div>
                <div class="col-6">
                    <div class="info-position-img">
                        <img class="info-login-img" src="View/src/house-icon.png" alt="propietario">
                    </div>
                </div>
            </div>
            <div class="fila-info-login">
                <div class="col-6">
                    <div class="info-radio-login">
                        <input type="radio" name="usertype" value="traveller" required> Soy un traveller
                    </div>
                </div>
                <div class="col-6">
                    <div class="info-radio-login">
                        <input type="radio" name="usertype" value="owner"> Soy un anfitrión
                    </div>
                </div>
            </div>
            <div class="fila-submit-login">
                <div class="col-12">
                    <div class="botton-login">
                        <input type="submit" name="submit" value="Iniciar sesión" class="users-bottons">
                    </div>
                </div>
            </div>
            <div class="fila-info-login">
                <div class="col-4">
                    <a href="index.php?nu=%203" class="button">¿No tienes una cuenta? Regístrate </a>
                </div>
                <div class="col-4">
                    <a href="index.php?nu=%204" class="button">¿Has olvidado tu contraseña?</a>
                </div>
                <div class="col-4">
                    <a href="index.php" class="button">Volver</a>
                </div>
            </div>    
        </form>

        </section>