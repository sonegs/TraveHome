
<section class="principalLogin" id="loginzone">

    <div class="title-login">
        <div class="position-title-login">
            Inicie sesión
        </div>
    </div>
    <div class="fila-form-signup">
        <div class="col-12">
            <div class="signup">
                <form class="form-signup" action="" method="POST">
                    <input type="email" id="inputEmail" class="signup_form" name="email" placeholder="Email address" required autofocus><br>  
                    <input type="password" id="inputPassword" class="signup_form" name="contrasena" placeholder="Password" required>
            </div>
        </div>
    </div>  
    <div class="fila-info-login">
            <div class="info-position-img">
                <img class="info-login-img" id="traveller-icon" src="View/src/bag-icon.png" alt="viajero">
            </div>
            <div class="info-position-img">
                <img class="info-login-img" id="owner-icon" src="View/src/house-icon.png" alt="propietario">
            </div>
    </div>
    <div class="select-user">
        <div class="typeofuser">
            <input type="radio" name="usertype" value="traveller" id="traveller-option" class="radio-signup" required> Soy un traveller
        </div>
        <div class="typeofuser">
            <input type="radio" name="usertype" value="owner" id="owner-option" class="radio-signup"> Soy un anfitrión<br>
        </div>
    </div>
    <div class="send">
        <button class="users-buttons" type="submit" name="submit">Iniciar sesión</button><br><br>
    </div>
    <div class="fila-login-others">
        <div class="position-login-others">
                <a href="index.php?nu=%203" class="button">¿No tienes una cuenta? Regístrate </a>
            </div>          
            <div class="position-login-others">
                <a href="index.php" class="button">Volver</a>
            </div>          
            <div class="position-login-others">
                <a href="index.php?nu=%204" class="button">¿Has olvidado tu contraseña?</a>
            </div>          
        </div>          
    </div> 


            

                </form>
            </div>
        </div>
        
    </div>
    <?php

if(isset($_POST['submit'])) {

    include 'Model/queries/queries_users.php';
    login();

    }
?>  
</section>