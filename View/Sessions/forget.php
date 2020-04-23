<section class="principalForget">
<div class="title-signup">
        <div class="center-title-signup">
            <div class="info-title-signup">
                Reenvio de contraseña
            </div>
        </div>
    </div>
    <div class="fila-form-signup">
        <div class="col-12">
            <div class="signup">
                <form class="form-signup" action="" method="POST">
                    <input type="email" id="inputEmail" class="signup_form" name="email" placeholder="Email address" required autofocus><br>  
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
    <div class="radio-buttons">
        <div class="typeofuser">
            <input type="radio" name="usertype" value="traveller" id="traveller-option" class="radio-signup" required> Soy un traveller
        </div>
        <div class="typeofuser">
            <input type="radio" name="usertype" value="owner" id="owner-option" class="radio-signup"> Soy un anfitrión<br>
        </div>
    </div>
    <div class="send">
        <input type="submit" name="submit" value="Enviar correo" class="users-buttons">
    </div>
    <div class="fila-login-others">
        <div class="position-signup-others">
            <a href="index.php?nu=%202" class="signup-button">¿Tienes una cuenta? Inicia sesión </a>
        </div>
        <div class="position-signup-others">
            <a href="index.php" class="button">Volver</a>
        </div>
    </div>

                <?php
                
                if(isset($_POST['submit'])){
            
                        include "Model/queries/queries_users.php";
                        forgetUser(); 
            
                }
            
                ?>

                </form>
            </div>
        </div>
    </div>  
</section>
