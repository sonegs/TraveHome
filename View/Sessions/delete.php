<section class="main">
    <form class="form-signin" action="" method="POST" name="form_usuario">
        <h1 class="h3 mb-3 font-weight-normal">¿DESEA ELIMINAR SU CUENTA?</h1><br>
        <h4>Si hace esto, no podrá volver a disfrutar de las ventajas de TraveHome</h4><br>
        <input type="submit" name="submit" value="Eliminar cuenta" class="input_form">
        <a href="../index.php" class="button"> Volver </a>
    </form>
</section>

<?php

include "Model/queries/queries_users.php";  

if(isset($_POST['submit'])){
        
    deleteUser(); 

}

?>