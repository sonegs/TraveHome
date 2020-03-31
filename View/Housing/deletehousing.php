<section class="main">
    <form enctype="multipart/form-data" action="" method="POST">
            <h1 class="title">My Housing</h1>
            <img class="mb-4" src="src/logo.png" alt="" width="172" height="172">
            <h1 class="h3 mb-3 font-weight-normal">¿Está seguro de que quiere eliminar la siguiente vivienda?</h1>
            <p value="<?php echo $_POST['nameHouse']?>"></p>
            <input type="number" name="idHouse" value="<?php echo $_POST['idHouse']?>" class="input_form" hidden>
            <h4><?php echo $_POST['nameHouse']?></h4>
            <img src="View/uploads/<?php echo $_POST['name_img']?>"><br>
            <input type="submit" name="submit" value="Eliminar" class="input_form">
            <input type="submit" name="reset" value="Cancelar" class="input_form">
            </div>
        </form>
    </section>

    <?php  

    

            if(isset($_POST['submit'])){
                
                include "Model/queries/queries_housing.php";
                deleteHousing();
                header('Location: index.php?ow=%203');
                
            }

            if(isset($_POST['reset'])){
                
                header('Location: index.php?ow=%203');
                
            }
            
    ?>