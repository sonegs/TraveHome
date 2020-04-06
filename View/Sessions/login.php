<section class="principalLogin" id="loginzone">
    

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
                <div class="col-6" id="clickme">
                    <div class="info-position-img">
                            <img class="info-login-img" id="mochila" src="View/src/bag-icon.png" alt="viajero">
                    </div>
                </div>
                <div class="col-6">
                    <div class="info-position-img">
                            <img class="info-login-img" id="casa" src="View/src/house-icon.png" alt="propietario">
                    </div>
                </div>
            </div>
            <div class="fila-info-login">
                <div class="col-6">
                    <div class="info-radio-login">
                        <input type="radio" name="usertype" value="traveller" id="traveller-option" required> Soy un traveller
                    </div>
                </div>
                <div class="col-6">
                    <div class="info-radio-login">
                        <input type="radio" name="usertype" value="owner" id="owner-option"> Soy un anfitrión
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
            <?php

if(isset($_POST['submit'])) {

    include 'Model/queries/queries_users.php';
    login();

}
?>
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