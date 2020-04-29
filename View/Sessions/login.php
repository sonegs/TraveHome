
<section class="principalLogin" id="loginzone">

    <div class="title-login">
        <div class="position-title-login">
            Inicie sesión
        </div>
    </div><?php

if(isset($_POST['submit'])) {

    include 'Model/queries/queries_users.php';
    login();

    }
?>  
    <div class="fila-form-signup">
        <div class="col-12">
            <div class="signup">
                <form class="form-signup" action="" method="POST">
                    
                    
                    <input type="email" id="inputEmail" class="signup_form" name="email" placeholder="Email address" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" value=""  minlength="14" required ><br><br>
                    <input type="password" id="inputPassword" placeholder="Password" name="contrasena" title="Debe ser mínimo de 5 caracteres y sin espacios" pattern="[a-zA-Z_0-9!@#$%&/()=?¿¡!-_Ç€*]+" minlength="5" value="" class="signup_form" required><br><br>

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
    
</section>