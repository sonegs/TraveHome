<section class="main">
    <form enctype="multipart/form-data" action="" method="POST">
            <h1 class="title">My Housing</h1>
            <img class="mb-4" src="src/logo.png" alt="" width="172" height="172">
            <h1 class="h3 mb-3 font-weight-normal">¿Quieres modificar datos de tu vivienda</h1>
            <h5>Nombre</h5><input type="text" name="nombre" maxlength="30" value="" class="input_form" required ><br><br>
            <h5>Dirección</h5><input type="text" name="direccion" value="" class="input_form" required><br><br>
            <h5>Código postal</h5><input type="number" name="cp" value="" class="input_form" maxlength="6" required><br><br>
            <input type="hidden" name="MAX_FILE_SIZE" value="200000" />
            <input type="number" name="idHouse" value="<?php echo $_POST['idHouse']?>" class="input_form" hidden>
            <input name="uploadedfile" type="file" multiple accept="image/png, image/gif, image/jpeg, image/jpg" required/>
            <input type="submit" name="submit" value="Añadir" class="input_form">
            <input type="reset" name="reset" value="Cancelar" class="input_form">
            </div>
        </form>
    </section>

    <?php  
    
            if(isset($_POST['submit'])){
                
                include "Model/queries/queries_housing.php";
                editHousing();
                
            }
            
    ?>