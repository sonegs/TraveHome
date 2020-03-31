<section class="main">

<form class="comment" method="POST" action="">
  <p class="clasificacion">
    <input id="radio1" type="radio" name="estrellas" value="5">
    <label for="radio1">★</label>
    <input id="radio2" type="radio" name="estrellas" value="4">
    <label for="radio2">★</label>
    <input id="radio3" type="radio" name="estrellas" value="3">
    <label for="radio3">★</label>
    <input id="radio4" type="radio" name="estrellas" value="2">
    <label for="radio4">★</label>
    <input id="radio5" type="radio" name="estrellas" value="1">
    <label for="radio5">★</label>
  </p>

<label for="comentario">Deje aquí su comentario sobre su estancia en la vivienda</label><br>
<input type="text" id="comentario" name="comentario"><br>
<input type="submit" name="submit" value="Enviar" class="input_form">
<a href="index.php?ow=%200" class="button">Volver </a>

            <?php

                include "Model/queries/queries_comments.php";
                
                if(isset($_POST['submit'])){

                    if(!empty($_POST['comentario']) && !empty($_POST['estrellas'])){ // si hay comentario y valoracion
                    
                        sendComment($_POST['id-booking'], $_POST['id-housing']);
                
                    }else {

                    echo "<h4>Valore la estancia y esscriba un comentario para poder enviarlo</h4>";

                    }

                }

            ?>
        </form>
    </section>
            