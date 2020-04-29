<section class="totalSignup">

    <div class="title-signup">
        <div class="center-title-signup">
            <div class="info-title-signup">
                Crea tu cuenta
            </div>
        </div>
    </div>
    <?php
                                    
                if(isset($_POST['submit'])){

                        include "Model/queries/queries_users.php";
                        insertUser();
                                                                                                 
                } 
                                
                ?>
            <div class="fila-form-signup">
                <div class="col-12">
                    <div class="signup">
                        <form class="form-signup" method="POST" action="">
                            <h5>Nombre</h5><input type="text" name="nombre" pattern="[a-zA-Z ñÑáéíóúÁÉÍÓÚ]+" minlength="2" maxlength="30" value="" class="signup_form" required ><br><br>
                            <h5>Apellidos</h5><input type="text" name="apellidos" ppattern="[a-zA-Z ñÑáéíóúÁÉÍÓÚ]+" minlength="2" maxlength="60" value="" class="signup_form" required ><br><br>
                            <h5>DNI</h5><input type="text" pattern="[0-9]{8}[A-Z]{1}" title="Debe contener 8 números y una letra mayúscula" name="dni" value="" class="signup_form" maxlength="9" minlength="9" required><br><br>
                            <h5>Número de teléfono. No olvides poner el prefijo de tu país (p.e. España: 34)</h5><input type="number" name="telefono" pattern="[0-9]" value="" class="signup_form" min="1000000" max="99999999999999" required><br><br>
                            <h5>Email</h5><input type="email" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" value="" class="signup_form" minlength="14" required><br><br>
                            <h5>Contraseña</h5><input type="password" name="contrasena" title="Debe ser mínimo de 5 caracteres y sin espacios" pattern="[a-zA-Z_0-9!@#$%&/()=?¿¡!-_Ç€*]+" minlength="5" value="" class="signup_form" required><br><br>
                            <h5>Dirección</h5><input type="text" name="direccion" value="" pattern="[a-zA-Z0-9 ñÑáéíóúÁÉÍÓÚ-]+" minlength="8" class="signup_form" required><br><br>
                            <h5>Código postal</h5><input type="number" name="cp" pattern="[0-9]+" value="" class="signup_form" minlength="4" maxlength="6" minlength="5" required><br><br>
                            <h5>Ciudad</h5><input type="text" name="ciudad" pattern="[a-zA-Z ñÑáéíóúÁÉÍÓÚ]+" value="" class="signup_form" minlength="P2" required><br><br>
                            <h5>País</h5><input type="text" name="pais" pattern="[a-z A-ZñÑáéíóúÁÉÍÓÚ]+" value="España" class="signup_form" minlength="3" required><br><br>
                            <div class="select-user">
                                <div class="type-signup">
                                    <input type="radio" name="usertype" value="traveller" id="traveller-option" class="radio-signup" required> Soy un traveller
                                </div>
                                <div class="type-signup">
                                    <input type="radio" name="usertype" value="owner" id="owner-option" class="radio-signup"> Soy un anfitrión<br>
                                </div>
                            </div>
                            <div class="send">
                                <input type="submit" name="submit" value="Crear" class="users-buttons">
                            </div>
                            <div class="fila-login-others">
                                <div class="position-signup-others">
                                    <a href="index.php?nu=%202" class="signup-button">¿Tienes una cuenta? Inicia sesión </a>
                                </div>
                                <div class="position-signup-others">
                                    <a href="index.php" class="signup-button">Volver</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        
</section>
