<section class="principalForget">
    <div class="title-signup">
        Escriba su dirección de correo electrónico
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
        <div class="col-6">
            <div class="info-position-img">
                <img class="info-login-img" id="traveller-icon" src="View/src/bag-icon.png" alt="viajero">
            </div>
        </div>
        <div class="col-6">
            <div class="info-position-img">
                <img class="info-login-img" id="owner-icon" src="View/src/house-icon.png" alt="propietario">
            </div>
        </div>
    </div>
    <div class="fila-form-forget">
        <div class="col-12">
            <div class="signup">
                <input type="radio" name="usertype" value="traveller" id="traveller-option" class="radio-signup" required> Soy un traveller
                <input type="radio" name="usertype" value="owner" id="owner-option" class="radio-signup"> Soy un anfitrión<br>
                <button class="users-bottons" type="submit" name="submit">Enviar</button><br><br>
                <a href="index.php" class="button">Volver</a><br><br>


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
