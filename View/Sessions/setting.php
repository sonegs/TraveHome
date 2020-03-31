<section class="main">
    <form class="form-signup" method="POST" action="">
            <h1 class="h3 mb-3 font-weight-normal">Configuración de tu cuenta</h1>
            <h5>DNI. Debe ser el mismo con el que te inscribiste a Travehome</h5><input type="text" name="dni" value="" class="input_form" maxlength="9" minlength="8" required><br><br>
            <h5>Número de teléfono</h5><input type="number" name="telefono" value="" class="input_form" maxlength="11" required><br><br>
            <h5>Email</h5><input type="email" name="email" value="" class="input_form" required><br><br>
            <h5>Contraseña</h5><input type="password" name="contrasena" minlength="5" value="" class="input_form" required><br><br>
            <h5>Confirmar contraseña</h5><input type="password" name="contrasena2" minlength="5" value="" class="input_form" required><br><br>
            <h5>Dirección</h5><input type="text" name="direccion" value="" minlength="7" class="input_form" required><br><br>
            <h5>Código postal</h5><input type="number" name="cp" value="" class="input_form" maxlength="6" minlength="5" required><br><br>
            <h5>Ciudad</h5><input type="text" name="ciudad" value="" class="input_form" required><br><br>
            <h5>País</h5><input type="text" name="pais" value="España" class="input_form" required><br><br>
            
            
            <?php

            if(isset($_SESSION['traveller'])){

            ?>                       
                <a href="index.php?tr=%207" class="button">¿Desea eliminar su cuenta? </a>  
            <?php
            
            }

            if(isset($_SESSION['owner'])){

            ?>  
                <a href="index.php?ow=%208" class="button">¿Desea eliminar su cuenta? </a>
            <?php
            
            } 
            ?>
            <a href="index.php?ow=%200" class="button">Volver </a><br>
            <input type="submit" name="submit" value="Modificar" class="input_form">
            <?php

                session_start();
                include "Model/queries/queries_users.php";

                if(isset($_POST['submit'])){
                    
                    if(isset($_POST['contrasena']) && isset($_POST['contrasena2']) && ($_POST['contrasena']) == ($_POST['contrasena2'])){    
              
                        editUser('dni','telefono', 'email', 'contrasena', 'direccion', 'cp', 'ciudad', 'pais');
                                              
                }  else {

                    echo "<h3>No coinciden las contraseñas!!</h3>";

        }
    }
            ?>
        </form>
    </section>