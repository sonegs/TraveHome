<?php

/*

***************************************************************************
************************ FUNCIONES DE LAS VIVIENDAS ***********************
***************************************************************************

*/

// INSERTAR VIVIENDAS

function insertHousing() { // le pasamos los valores necesarios para insertar un registro
    
    include "Model/DDBB/connection.php";
    
    // Recogemos los valores del formulario de registro y de la sesión

    $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;
    $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : false;
    $direccion = isset($_POST['direccion']) ? $_POST['direccion'] : false;
    $cp = isset($_POST['cp']) ? $_POST['cp'] : false;
    $ciudad = isset($_POST['ciudad']) ? $_POST['ciudad'] : false;
    $pais = isset($_POST['pais']) ? $_POST['pais'] : false;
    $id = $_SESSION['owner']['ID']; // coge el id del usuario actual

    // Declaramos las variables para guardar la imagen y validarla

    $uploadedfileload = 'true'; //nos sirve para validar la imagen subida
    $uploadedfile_size = $_FILES['uploadedfile'][200000]; //limita el tamaño de la imagen
    $nombreImagen = $_FILES['uploadedfile']['name']; // mete la imagen enviada en una variable
    $name_img = date('Y-m-d-h:i:s').'-'.$id.'-'.$nombreImagen; //cambia el nombre de la imagen subida a uno único
    $uploads_dir = 'View/uploads/'.$name_img; // elige el directorio donde se alojará la imagen

    // Validamos la información del formulario antes de insertarla a través del array $errores
    
    $errores = array();

    if ($nombre && !is_numeric($nombre) && !preg_match("/[0-9]/", $nombre)) {
        $nombre_validado = true;
    } else {
        $nombre_validado = false;
        $errores['nombre'] = "El campo nombre es inválido";
    }
    if (!empty($descripcion)) {
        $descripcion_validado = true;
    } else {
        $descripcion_validado = false;
        $errores['descripcion'] = "El campo descripcion está vacía";
    }
    if (!empty($direccion)) {
        $direccion_validado = true;
    } else {
        $direccion_validado = false;
        $errores['direccion'] = "El campo direccion está vacía";
    }
    if ($cp && is_numeric($cp)) {
        $cp_validado = true;
    } else {
        $cp_validado = false;
        $errores['cp'] = "El campo Código Postal es inválido";
    }
    if ($ciudad && !is_numeric($ciudad) && !preg_match("/[0-9]/", $ciudad)) {
        $ciudad_validado = true;
    } else {
        $ciudad_validado = false;
        $errores['ciudad'] = "El campo ciudad es inválido";
    }
    if ($pais && !is_numeric($pais) && !preg_match("/[0-9]/", $pais)) {
        $pais_validado = true;
    } else {
        $pais_validado = false;
        $errores['pais'] = "El campo pais es inválido";
    }
    if (!empty($name_img)) {
        $name_img_validado = true;
    } else {
        $name_img_validado = false;
        $errores['nombre_img'] = "El nombre de la imagen es inválido";
    } 
    // Validamos la información de la imagen antes de subirla
        // Si la imagen pesa más de 200KB, para no sobrecargar el servidor

    if ($_FILES['uploadedfile']['size'] <= 200000) { 
        $size_img_validado = true;
    } else {
        $size_img_validado = false;
        $errores['size_img'] = '<h4>El tamaño de la imagen es mayor de 20 KB, debes reduzcirlo antes de subirlo</h4><br>';
        $uploadedfileload = "false"; //por seguridad, para que no suba la imagen
    }
    if (($_FILES['uploadedfile']['type'] == 'image/jpeg' OR $_FILES['uploadedfile']['type'] == 'image/png' OR $_FILES['uploadedfile']['type'] == 'image/jpg')) {
    // Si la imagen no tiene un formato de imagen válido
        $type_img_validado = true;
    } else {
        $type_img_validado = false;
        $errores['type_img'] = '<h4>Tu archivo tiene que ser JPG, JPEG o PNG. Otros archivos no son permitidos</h4><br>';
        $uploadedfileload = "false"; //por seguridad, para que no suba la imagen
    }

    $guardar_vivienda = false;
    
    if(count($errores) == 0) {
        
        $guardar_vivienda = true;

    } else {

        echo "<h5>Hay algun error en los datos rellenados. Por favor, compruebe que se han introducido correctamente</h5>";
        var_dump($errores);
        exit();

    }

    
    // si no hay errores, subiremos la imagen a la carpeta uploads
    
    if ($uploadedfileload == true) { 
               
        if(move_uploaded_file ($_FILES['uploadedfile']['tmp_name'], $uploads_dir)){ // si se ha movido la imagen
            
            echo 'La imagen ha sido subido satisfactoriamente'; 
            
        } else {

            echo 'Ha ocurrido un problema al subir la imagen de su vivienda';

        }
        
    }

    // formulamos la query y la enviamos a la bbdd

    $query = "INSERT INTO Housing (Name_home, Name_img, Description, Address, PC, City, Country, ID_owner ) VALUES ('$nombre','$name_img', '$descripcion', '$direccion','$cp','$ciudad','$pais', '$id');";    
    
    if (mysqli_query($con, $query)) {

        echo "<h1>Se ha introducido correctamente</h1>";
        
    } else{

        echo "<h1>Se ha producido un error en la consulta</h1>";
        //var_dump($con);
        //var_dump($query);

    }

    $con -> close();

}


// EDITAR VIVIENDAS

    function editHousing() { // hay que pasarle las variables nombre y contraseña para identificar al usuario que vamos a eliminar

    include "Model/DDBB/connection.php";
    
    // Recogemos los valores del formulario de registro de cambios

    $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;
    $descripcion = isset($_POST['descripcion']) ? $_POST['descripcion'] : false;
    $direccion = isset($_POST['direccion']) ? $_POST['direccion'] : false;
    $cp = isset($_POST['cp']) ? $_POST['cp'] : false;
    $idHouse = isset($_POST['idHouse']) ? $_POST['idHouse'] : false;
    $idOwner = $_SESSION['owner']['ID']; // coge el id del usuario actual

    // Declaramos las variables para guardar la imagen y validarla

    $uploadedfileload = 'true'; //nos sirve para validar la imagen subida
    $uploadedfile_size = $_FILES['uploadedfile'][200000]; //limita el tamaño de la imagen
    $nombreImagen = $_FILES['uploadedfile']['name']; // mete la imagen enviada en una variable
    $name_img = date('Y-m-d-h:i:s').'-'.$idOwner.'-'.$nombreImagen; //cambia el nombre de la imagen subida a uno único
    $uploads_dir = 'View/uploads/'.$name_img; // elige el directorio donde se alojará la imagen

    // Validamos la información del formulario antes de insertarla

    $errores = array();

    if ($nombre && !is_numeric($nombre) && !preg_match("/[0-9]/", $nombre)) {
        $nombre_validado = true;
    } else {
        $nombre_validado = false;
        $errores['nombre'] = "El campo nombre es inválido";
    }
    if (!empty($descripcion)) {
        $descripcion = true;
    } else {
        $descripcion = false;
        $errores['descripcion'] = "El campo descripcion está vacía";
    }
    if (!empty($direccion)) {
        $direccion_validado = true;
    } else {
        $direccion_validado = false;
        $errores['direccion'] = "El campo direccion está vacía";
    }
    if ($cp && is_numeric($cp)) {
        $cp_validado = true;
    } else {
        $cp_validado = false;
        $errores['cp'] = "El campo Código Postal es inválido";
    }
    if (!empty($name_img)) {
        $name_img_validado = true;
    } else {
        $name_img_validado = false;
        $errores['nombre_img'] = "El nombre de la imagen es inválido";
    }

    $guardar_vivienda = false;
    
    if(count($errores) == 0) {
        
        $guardar_vivienda = true;

    } else {

        echo "<h5>Hay algun error en los datos rellenados. Por favor, compruebe que se han introducido correctamente</h5>";

    }

    // Validamos la información de la imagen antes de subirla

    if ($_FILES['uploadedfile']['size'] > 200000) { // si la imagen pesa más de 200KB
        
        $msg = $msg."<h4>El archivo es mayor que 20 KB, debes reduzcirlo antes de subirlo</h4><br>";
        $uploadedfileload="false";

    }

    if (!($_FILES['uploadedfile']['type'] == 'image/jpeg' OR !$_FILES['uploadedfile']['type'] == 'image/gif' OR !$_FILES['uploadedfile']['type'] == 'image/png' OR !$_FILES['uploadedfile']['type'] == 'image/jpg')) {
    // Si la imagen no tiene un formato de imagen válido
        $msg = $msg."<h4>Tu archivo tiene que ser JPG o GIF. Otros archivos no son permitidos</h4><br>";
        
        $uploadedfileload="false";

    }
    
    // si no hay errores, subiremos la imagen a la carpeta uploads

    if ($uploadedfileload == true) { 
                
        if(move_uploaded_file ($_FILES['uploadedfile']['tmp_name'], $uploads_dir)){ // si se ha movido la imagen
            
            echo 'La imagen ha sido subido satisfactoriamente'; 
            
        } else {

            echo 'Ha ocurrido un problema al subir la imagen de su vivienda';

        }
        
    }

    // formulamos la query y la enviamos a la bbdd
    
    $query= "UPDATE Housing SET Name_home = '$nombre', Name_img = '$name_img', Description = '$descripcion', Address = '$direccion', PC = '$cp' WHERE ID = '$idHouse'"; 

    if (mysqli_query($con, $query)) {
        
        echo "<h1>Se ha introducido correctamente</h1>";
        
    } else{

        echo "<h1>Se ha producido un error en la consulta</h1>";
        //var_dump($con);
        //var_dump($query);

    }

    $con -> close();
}

// ELIMINAR VIVIENDAS

function deleteHousing(){

    include "Model/DDBB/connection.php";

    //se recoge el ID de la casa para poder hacer la consulta. Se encuentra oculto en el formulario
    $idHouse = isset($_POST['idHouse']) ? $_POST['idHouse'] : false;
    
    $query= "DELETE FROM Housing WHERE ID = $idHouse";
    
    if (mysqli_query($con, $query)) {

        echo "<h4>Se ha eliminado correctamente</h4>";

    } else {

        echo "<h4>Se ha producido un error al conectar con la base de datos</h4>";

    }
    $con -> close();
    
}

// MOSTRAR LAS VIVIENDAS

function showHousing() {

    include "Model/DDBB/connection.php";

    //se distingue entre las consultas para que el traveller vea todas las viviendas y el owner vea solo las suyas
    //asi, se aprovecha el código de esta función para las dos pantallas
    
    if(isset($_SESSION['traveller'])){
        $busqueda = $_POST['looking'];
        if ($busqueda <> ''){

            $usertype = 'traveller';
            $query = "SELECT Housing.ID, Housing.Name_home, Housing.Description, Housing.Address, Housing.City, 
            Housing.Name_img, Housing.ID_owner FROM Housing WHERE Housing.Name_home LIKE '%$busqueda%' OR Housing.City 
            LIKE '%$busqueda%' OR Housing.Country LIKE '%$busqueda'";
        
        }
    }

    if(isset($_SESSION['owner'])){

        $usertype = 'owner';
        $id_owner = $_SESSION['owner']['ID']; // coge el id del usuario owner para la query
        $query = "SELECT Housing.ID, Housing.Name_home, Housing.Description, Housing.Address, Housing.City, 
        Housing.Name_img FROM Housing WHERE Housing.ID_owner = $id_owner";

    }
    
    
    $doQuery = mysqli_query($con, $query);
    if(mysqli_num_rows($doQuery)){ //si la consulta encuentra algun resultado, que nos muestre los campos de la tabla
        
        ?>
        <table class="housing-list" border=1>
         <?php
                        
        while ($datos = mysqli_fetch_row($doQuery)) { //nos muestra los resultados de la consulta
                            
        ?>

                <tr>
                    <td rowspan="5"><img class="info-cities-img" src="View/uploads/<?php echo $datos[5]?>"></td>
                    <td colspan="2"><?php echo $datos[1] ?></td>
                </tr>
                <tr>
                    <td><?php echo $datos[4] ?></td>
                    <td><?php echo $datos[3] ?></td>
                </tr>
                <tr>
                    <td colspan="2" rowspan="2"><?php echo $datos[2] ?></td>
                </tr>
                <tr>
                </tr>
                <tr>
            
                    <?php

                    if ($usertype == 'traveller'){ 
                            ?>

                        <td id="reservar">
                            <form action="index.php?tr=%208" method="POST"> 
                            <input type="number" name="idHouse" value="<?php echo $datos[0]?>" class="input_form" hidden>
                            <input type="text" name="name" value="<?php echo $datos[1]?>" class="input_form" hidden>
                            <input type="text" name="description" value="<?php echo $datos[2]?>" class="input_form" hidden>
                            <input type="text" name="name-img" value="<?php echo $datos[5]?>" class="input_form" hidden>
                            <input type="number" name="idOwner" value="<?php echo $datos[6]?>" class="input_form" hidden>
                            <input type="submit" value="Reservar" class="input_form">
                            </form>
                        </td>
     
                    <?php }

                    if ($usertype == 'owner'){?>

                        <td id="editar">
                            <form action="index.php?ow=%209" method="POST">                        
                                <input type="number" name="idHouse" value="<?php echo $datos[0]?>" class="input_form" hidden>
                                <input type="submit" value="Editar" class="input_form">
                            </form>
                        </td>
                        <td id="eliminar">
                            <form action="index.php?ow=%2011" method="POST">
                                <input type="number" name="idHouse" value="<?php echo $datos[0]?>" class="input_form" hidden>
                                <input type="text" name="nameHouse" value="<?php echo $datos[1]?>" class="input_form" hidden>
                                <input type="text" name="name_img" value="<?php echo $datos[5]?>" class="input_form" hidden>
                                <input type="submit" value="Eliminar" class="input_form">
                            </form>
                        </td>
                    <?php } ?>
         
                    </tr>
            
                    <?php
           
                    }
        
        

    } else {

            echo "<h4>No se han encontrado resultados para ese lugar</h4>";

        } 
        
        ?>

        </table>
                        
        <?php

        if (mysqli_query($con, $query)) {

        } else {

            echo "<h4>Se ha producido un error en la consulta</h4>";
            //var_dump($con);

        }

    $con-->close();

}

?>