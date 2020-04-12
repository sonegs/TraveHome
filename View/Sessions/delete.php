<section class="principalDelete">


<?php

include "Model/queries/queries_users.php";  

if(isset($_POST['submit'])){
        
    deleteUser(); 

}

?>

    <div class="title-signup">
        <div class="center-title-signup">
            <div class="info-title-signup">
                ¿Desea eliminar su cuenta?
            </div>
        </div>
    </div>

    <div class="fila-form-signup">
        <div class="col-12">
            <div class="signup">
                <form action="" method="POST">
                    <h4>Si hace esto, no podrá volver a disfrutar de las ventajas de TraveHome</h4><br>
                    <div class="books-buttons">
                        <input type="submit" name="submit" value="Eliminar cuenta" class="users-buttons" id="checkdates">
                    </div>
                    <div class="position-login-others">
                    <?php

                    if(isset($_SESSION['traveller'])){
                        ?>  

                        <a href="index.php?tr=%200" class="button">Volver</a> 
                        
                        <?php

                        }
                    if(isset($_SESSION['owner'])){
                        ?>  

                        <a href="index.php?ow=%200" class="button">Volver</a> 
                        
                        <?php
                        } 
                        ?>  

                        



                    </div>          
            
                    
                </form>
            </div>
        </div>
    </div>
</section>

