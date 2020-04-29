
<section class="mybookings">
<form enctype="multipart/form-data" action="" method="POST" class="house-form">
    <?php  
    
    if(isset($_POST['submit'])){
        
        include "Model/queries/queries_housing.php";
        editHousing();
        
    }
    
?>

<div class="title-signup">
    <div class="center-title-signup">
        <div class="info-title-signup">
            Edita tu vivienda
        </div>
    </div>
</div>

    <div class="fila-form-signup">
                <div class="col-12">
                    <div class="signup">
                        
                    <h5>Nombre</h5><input type="text" name="nombre" pattern="[a-zA-Z ñÑáéíóúÁÉÍÓÚ]+" minlength="2" maxlength="30" value="" class="signup_form" required ><br><br>
                        <h5>Características de la vivienda</h5><input type="text" name="descripcion" id="descripcion" value="Vivienda de dos dormitorios, un baño y piscina." pattern="[a-zA-Z0-9 ñÑáéíóúÁÉÍÓÚ-]+" minlength="100" class="textbox-description" required><br><br>
                        <h5>Dirección</h5><input type="text" name="direccion" value="" pattern="[a-zA-Z0-9 ñÑáéíóúÁÉÍÓÚ-]+" minlength="8" class="signup_form" required><br><br>
                        <h5>Código postal</h5><input type="number" name="cp" pattern="[0-9]+" value="" class="signup_form" minlength="4" maxlength="6" minlength="5" required><br><br>
                        <input type="hidden" name="MAX_FILE_SIZE" value="200000" />
                        <input type="number" name="idHouse" value="<?php echo $_POST['idHouse']?>" class="input_form" hidden>
                        <h5>
                            <input name="uploadedfile" type="file" class="users-buttons-housing" multiple accept="image/png, image/jpeg, image/jpg" required/>
                        </h5>
                        <div class="books-buttons">
                            <input type="submit" name="submit" value="Editar" class="users-buttons" id="checkdates">
                            <input type="reset" onclick="location.href='index.php?ow=02'" value="Cancelar" class="users-buttons">
                        </div>
                        
                        
                    </div>
                </div>
            </div>
        </form>
    </section>
