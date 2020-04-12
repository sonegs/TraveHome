
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
                        
                        <h5>Nombre</h5><input type="text" name="nombre" maxlength="30" value="" required ><br><br>
                        <h5>Características de la vivienda: </h5><input type="text" id="descripcion" name="descripcion" class="textbox-description"><br>
                        <h5>Dirección</h5><input type="text" name="direccion" value="" required><br><br>
                        <h5>Código postal</h5><input type="number" name="cp" value="" maxlength="6" required><br><br>
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
