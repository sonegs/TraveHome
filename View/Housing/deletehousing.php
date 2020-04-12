<section class="mybookings">
    <form class="house-form" method="POST" action="">
    
    <div class="title-signup">
        <div class="center-title-signup">
            <div class="info-title-signup">
                <?php echo $_POST['nameHouse']?>
            </div>
        </div>
    </div>
            <div class="subtitle-book"><?php echo $_POST['direccion'].' - '.$_POST['ciudad'].', '.$_POST['pais']?></div>
            <div class="imagen-book">
                <img name="name-img" class="image-book" src="View/uploads/<?php echo $_POST['name-img']?>">
            </div>
            <div class="size-description-book">
                <div class="position-description-book">
                    <div class="description-book"><?php echo $_POST['description']?></div>
                </div>
            </div>
            <input type="number" name="idHouse" value="<?php echo $_POST['idHouse']?>" class="input_form" hidden>
            <div class="delete-advice">¿Está seguro de que quiere eliminar esta vivienda</div>
            <div class="books-buttons">
                <input type="submit" name="submit" value="Eliminar" class="users-buttons" id="checkdates">
                <input type="reset" onclick="location.href='index.php?ow=02'" id="fechas" value="Cancelar" class="users-buttons">
            </div>
            </div>

    <?php  

    

            if(isset($_POST['submit'])){
                
                include "Model/queries/queries_housing.php";
                deleteHousing();
                header('Location: index.php?ow=%202');
                
            }

            
    ?>
        </form>
    </section>