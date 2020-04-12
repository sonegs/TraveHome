<section class="totalSignup">
<?php
                                    
    if(isset($_POST['submit'])){
        include "Model/queries/queries_users.php";
        insertUser();
                                        
    } 

    ?>
    <div class="title-signup">
        <div class="center-title-signup">
            <div class="info-title-signup">
                Crea tu cuenta
            </div>
        </div>
    </div>

            <div class="fila-form-signup">
                <div class="col-12">
                    <div class="signup">
                        <form class="form-signup" method="POST" action="">
                            <h5>Nombre</h5><input type="text" name="nombre" maxlength="30" value="" class="signup_form" required ><br><br>
                            <h5>Apellidos</h5><input type="text" name="apellidos" maxlength="60" value="" class="signup_form" required ><br><br>
                            <h5>DNI</h5><input type="text" name="dni" value="" class="signup_form" maxlength="9" minlength="8" required><br><br>
                            <h5>Número de teléfono. No olvides poner el prefijo de tu país (p.e. España: +34)</h5><input type="number" name="telefono" value="" class="signup_form" maxlength="11" required><br><br>
                            <h5>Email</h5><input type="email" name="email" value="" class="signup_form" required><br><br>
                            <h5>Contraseña</h5><input type="password" name="contrasena" minlength="5" value="" class="signup_form" required><br><br>
                            <h5>Confirmar contraseña</h5><input type="password" name="contrasena2" minlength="5" value="" class="signup_form" required><br><br>
                            <h5>Dirección</h5><input type="text" name="direccion" value="" minlength="7" class="signup_form" required><br><br>
                            <h5>Código postal</h5><input type="number" name="cp" value="" class="signup_form" maxlength="6" minlength="5" required><br><br>
                            <h5>Ciudad</h5><input type="text" name="ciudad" value="" class="signup_form" required><br><br>
                            <h5>País</h5><input type="text" name="pais" value="España" class="signup_form" required><br><br>
                            <div class="radio-buttons">
                                <input type="radio" name="usertype" value="traveller" class="radio-signup"> Soy un traveller
                                <input type="radio" name="usertype" value="owner" class="radio-signup" required> Soy un anfitrión<br>
                            </div>
                            <div class="send">
                                <input type="submit" name="submit" value="Crear" class="users-buttons">
                            </div>
                            <div class="fila-login-others">
                                <div class="position-signup-others">
                                    <a href="index.php?nu=%202" class="signup-button">¿Tienes una cuenta? Inicia sesión </a>
                                </div>
                                <div class="position-signup-others">
                                    <a href="index.php" class="button">Volver</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        
</section>
