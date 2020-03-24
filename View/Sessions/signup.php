
    <section class="main">
    <form class="form-signup" method="POST" action="">
            <h1 class="h3 mb-3 font-weight-normal">Crea tu cuenta</h1>
            <h5>Nombre</h5><input type="text" name="nombre" maxlength="30" value="" class="input_form" required ><br><br>
            <h5>Apellidos</h5><input type="text" name="apellidos" maxlength="60" value="" class="input_form" required ><br><br>
            <h5>DNI</h5><input type="text" name="dni" value="" class="input_form" maxlength="9" minlength="8" required><br><br>
            <h5>Número de teléfono. No olvides poner el prefijo de tu país (p.e. España: +34)</h5><input type="number" name="telefono" value="" class="input_form" maxlength="11" required><br><br>
            <h5>Email</h5><input type="email" name="email" value="" class="input_form" required><br><br>
            <h5>Contraseña</h5><input type="password" name="contrasena" minlength="5" value="" class="input_form" required><br><br>
            <h5>Dirección</h5><input type="text" name="direccion" value="" minlength="7" class="input_form" required><br><br>
            <h5>Código postal</h5><input type="number" name="cp" value="" class="input_form" maxlength="6" minlength="5" required><br><br>
            <h5>Ciudad</h5><input type="text" name="ciudad" value="" class="input_form" required><br><br>
            <h5>País</h5><input type="text" name="pais" value="España" class="input_form" required><br><br>
            <input type="radio" name="usertype" value="traveller"> Soy un traveller
            <input type="radio" name="usertype" value="owner"> Soy un anfitrión<br>
            <input type="submit" name="submit" value="Crear" class="input_form">
            <input type="reset" name="reset" value="Cancelar" class="input_form"><br>
            <a href="index.php?nu=%203" class="button">¿Tienes una cuenta? Inicia sesión </a><br>

            <?php
                
                $usertype = "";
                
                if(isset($_POST['submit'])){

                    $usertype = $_POST['usertype'];
                    
                    if($usertype == 'traveller'){
                        include "Model/consultas/consultas_viajeros.php";
                        insertarViajeros(); 

                    }

                    if ($usertype == 'owner') {
                        include "Model/consultas/consultas_propietarios.php";
                        insertarPropietarios();
                    
                    } 
                    
                }

            ?>
        </form>
    </section>
