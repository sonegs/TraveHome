<section class="totalSignup">

<div class="title-signup">
        <div class="center-title-signup">
            <div class="info-title-signup">
                Configuración de tu cuenta
            </div>
        </div>
    </div>

    <?php


include "Model/queries/queries_users.php";

if(isset($_POST['submit'])){
    
    if(isset($_POST['contrasena']) && isset($_POST['contrasena2']) && ($_POST['contrasena']) == ($_POST['contrasena2'])){    

        editUser('dni','telefono', 'email', 'contrasena', 'direccion', 'cp', 'ciudad', 'pais');
                              
}  else {

    echo "<h1 class='form-signup'>No coinciden las contraseñas!!</h1>";

}
}
?>
            <div class="fila-form-signup">
                <div class="col-12">
                    <div class="signup">
                    <form class="form-signup" method="POST" action="">
                    <h5>DNI. Debe ser el mismo con el que te inscribiste a Travehome</h5><input type="text" pattern="[0-9]{8}[A-Z]{1}" title="Debe contener 8 números y una letra mayúscula" name="dni" value="" class="signup_form" maxlength="9" minlength="9" required><br><br>
                    <h5>Número de teléfono. No olvides poner el prefijo de tu país (p.e. España: 34)</h5><input type="number" name="telefono" pattern="[0-9]" value="" class="signup_form" min="1000000" max="99999999999999" required><br><br>
                    <h5>Email</h5><input type="email" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" value="" class="signup_form" minlength="12" required><br><br>
                    <h5>Contraseña</h5><input type="password" name="contrasena" title="Debe ser mínimo de 5 caracteres y sin espacios" pattern="[a-zA-Z_0-9!@#$%&/()=?¿¡!-_Ç€*]+" minlength="5" value="" class="signup_form" required><br><br>
                    <h5>Confirmar contraseña</h5><input type="password" name="contrasena2" title="Debe ser mínimo de 5 caracteres y sin espacios" pattern="[a-zA-Z_0-9!@#$%&/()=?¿¡!-_Ç€*]+" minlength="5" value="" class="signup_form" required><br><br>
                    <h5>Dirección</h5><input type="text" name="direccion" value="" pattern="[a-zA-Z0-9 ñÑáéíóúÁÉÍÓÚ-]+" minlength="8" class="signup_form" required><br><br>
                    <h5>Código postal</h5><input type="number" name="cp" pattern="[0-9]+" value="" class="signup_form" minlength="4" maxlength="6" minlength="5" required><br><br>
                    <h5>Ciudad</h5><input type="text" name="ciudad" pattern="[a-zA-Z ñÑáéíóúÁÉÍÓÚ]+" value="" class="signup_form" minlength="P2" required><br><br>
                    <h5>País</h5><input type="text" name="pais" pattern="[a-z A-ZñÑáéíóúÁÉÍÓÚ]+" value="España" class="signup_form" minlength="3" required><br><br>
    
                            <div class="fila-setting-others">
                                <div class="position-setting-others">
            
                                <?php

                                if(isset($_SESSION['traveller'])){

                                ?>                       
                                    <a href="index.php?tr=%205" class="button">¿Desea eliminar su cuenta? </a>  
                                    <a href="index.php?tr=%200" class="button">Volver </a><br>
                                <?php
                                
                                }

                                if(isset($_SESSION['owner'])){

                                ?>  
                                    <a href="index.php?ow=%207" class="button">¿Desea eliminar su cuenta? </a>
                                    <a href="index.php?ow=%200" class="button">Volver </a><br>
                                <?php
                                
                                } 
                                ?>
                                
                                </div>
                                <div class="send">
                                    <input type="submit" name="submit" value="Modificar" class="users-buttons">
                                </div>

                                </div>
                            </div>
                        
                    </div>
                </div>
            </div>
        </div>
        </form>
</section>
