<section class="totalSignup">

<div class="title-signup">
        <div class="center-title-signup">
            <div class="info-title-signup">
                Configuración de tu cuenta
            </div>
        </div>
    </div>

            <div class="fila-form-signup">
                <div class="col-12">
                    <div class="signup">
                    <form class="form-signup" method="POST" action="">
                            <h5>DNI. Debe ser el mismo con el que te inscribiste a Travehome</h5><input type="text" name="dni" value="" class="signup_form" maxlength="9" minlength="8" required><br><br>
                            <h5>Número de teléfono. No olvides poner el prefijo de tu país (p.e. España: 34)</h5><input type="number" name="telefono" value="" class="signup_form" maxlength="11" required><br><br>
                            <h5>Email</h5><input type="email" name="email" value="" class="signup_form" required><br><br>
                            <h5>Contraseña</h5><input type="password" name="contrasena" minlength="5" value="" class="signup_form" required><br><br>
                            <h5>Confirmar contraseña</h5><input type="password" name="contrasena2" minlength="5" value="" class="signup_form" required><br><br>
                            <h5>Dirección</h5><input type="text" name="direccion" value="" minlength="7" class="signup_form" required><br><br>
                            <h5>Código postal</h5><input type="number" name="cp" value="" class="signup_form" maxlength="6" minlength="5" required><br><br>
                            <h5>Ciudad</h5><input type="text" name="ciudad" value="" class="signup_form" required><br><br>
                            <h5>País</h5><input type="text" name="pais" value="España" class="signup_form" required><br><br>
                            
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
