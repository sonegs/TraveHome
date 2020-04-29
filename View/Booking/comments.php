<section class="mybookings">
<div class="title-comment">
        <div class="center-title-signup">
            <div class="info-title-signup">
                Enviar valoración sobre la vivienda
            </div>
        </div>
    </div>
    <div class="fila-form-signup">
        <div class="col-12">
            <div class="signup">
                <form class="comment" method="POST" action="" required>
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

                  <div class="comentario">Deje aquí su comentario sobre su estancia en la vivienda</div><br>
                  <div class="position-textbox-comment">
                    <input type="text" id="comentario" name="comentario" class="textbox-comment"><br>
                  </div>
                  <div class="submit-comment">
                    <input type="submit" name="submit" value="Enviar" class="users-buttons">
                  </div>  
                  <input type="number" name="id-booking" value=<?php echo $_POST['id-booking'] ?> hidden>
                  <input type="number" name="id-housing" value=<?php echo $_POST['id-housing'] ?> hidden>
                  <div class="submit-comment">
                    <a href="index.php?tr=%202" class="button">Volver </a>
                  </div>

        </form>
            <?php


                include "Model/queries/queries_comments.php";
                
                if(isset($_POST['submit'])){

                    if(!empty($_POST['comentario']) && !empty($_POST['estrellas'])){ // si hay comentario y valoracion
                    
                        sendComment();
                
                    }else {

                    echo "<h4>Valore la estancia y esscriba un comentario para poder enviarlo</h4>";

                    }

                }

            ?>
              </div>
              </div>
              </div>
    </section>
            