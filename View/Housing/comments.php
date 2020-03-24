<section class="main">
    <form class="form-signup" method="POST" action="">
            <label for="comentario">Deje aquí su comentario sobre la vivienda</label><br>
            <input type="text" id="comentario" name="fname"><br>
            <input type="submit" name="submit" value="Modificar" class="input_form">
            <a href="index.php?ow=%200" class="button">Volver </a>

            <?php

                session_start();
                include "Model/consultas/consultas_viajeros.php";
                include "Model/consultas/consultas_propietarios.php";
                
                if(isset($_POST['submit'])){
                        
                    enviarComentario();
                
                }else {

                    echo "<h4>Escriba un comentario para poder enviarlo</h4>";

                }

            ?>
        </form>
    </section>