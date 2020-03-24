<?php

/*

***************************************************************************
************************ FUNCIONES DE LAS VIVIENDAS ***********************
***************************************************************************

*/

// INSERTAR VIVIENDAS

function insertarVivienda() { // le pasamos los valores necesarios para insertar un registro
    
    include "Model/DDBB/conexion.php";
    
    // Recogemos los valores del formulario de registro

    $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;
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

    // Validamos la información del formulario antes de insertarla

    $errores = array();

    if ($nombre && !is_numeric($nombre) && !preg_match("/[0-9]/", $nombre)) {
        $nombre_validado = true;
    } else {
        $nombre_validado = false;
        $errores['nombre'] = "El campo nombre es inválido";
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
        $pais_validado = true;
    } else {
        $pais_validado = false;
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

    $query = "INSERT INTO Housing (Name_home, Name_img, Address, PC, City, Country, ID_owner ) VALUES ('$nombre','$name_img', '$direccion','$cp','$ciudad','$pais', '$id');";    
    

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

    function editarViviendas($nombre, $direccion, $cp, $telefono, $nombreImagen) { // hay que pasarle las variables nombre y contraseña para identificar al usuario que vamos a eliminar

        include "Model/DDBB/conexion.php";
    
    // Recogemos los valores del formulario de registro

    $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : false;
    $direccion = isset($_POST['direccion']) ? $_POST['direccion'] : false;
    $cp = isset($_POST['cp']) ? $_POST['cp'] : false;
    $id = $_SESSION['owner']['ID']; // coge el id del usuario actual

    // Declaramos las variables para guardar la imagen y validarla

    $uploadedfileload = 'true'; //nos sirve para validar la imagen subida
    $uploadedfile_size = $_FILES['uploadedfile'][200000]; //limita el tamaño de la imagen
    $nombreImagen = $_FILES['uploadedfile']['name']; // mete la imagen enviada en una variable
    $name_img = date('Y-m-d-h:i:s').'-'.$id.'-'.$nombreImagen; //cambia el nombre de la imagen subida a uno único
    $uploads_dir = 'View/uploads/'.$name_img; // elige el directorio donde se alojará la imagen

    // Validamos la información del formulario antes de insertarla

    $errores = array();

    if ($nombre && !is_numeric($nombre) && !preg_match("/[0-9]/", $nombre)) {
        $nombre_validado = true;
    } else {
        $nombre_validado = false;
        $errores['nombre'] = "El campo nombre es inválido";
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

    //***********************************************************************
    //AQUI HAS PUESTO EL ID DE LA CASA, PERO HABRA QUE COGERLO DE ALGUNA FORMA
    //***********************************************************************


    $query= "UPDATE Housing SET Name_home = '$name', Name_img = '$name_img', Address = '$direccion', PC = '$cp' WHERE ID = '$id_house'"; 

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

// MOSTRAR LAS VIVIENDAS QUE HAN SUBIDO LOS PROPIETARIOS

function mostrarViviendasOwner() {

    include "Model/DDBB/conexion.php";
    $id_owner = $_SESSION['owner']['ID']; // coge el id del usuario actual
    $query = "SELECT ID, Name_home, Address, PC, City, Country FROM Housing WHERE ID_owner = $id_owner";
    $doQuery = mysqli_query($con, $query);
    
        while ($fila = mysqli_fetch_row($doQuery)) {
            
            ?>
            
            <tr>
            <td><?php echo $fila[1] ?></td>
            <td><?php echo $fila[2] ?></td>
            <td><?php echo $fila[3] ?></td>
            <td><?php echo $fila[4] ?></td>
            <td><?php echo $fila[5] ?></td>
            <td><?php echo $fila[6] ?></td>
            <td><button onclick = "window.location.assign('index.php?ow=%208')" id="edit">Editar</button></td>
            <td><button onclick = "window.location.assign('index.php?ow=%203')" id="remove">Eliminar</button></td>
                        
            </tr>
            
            <?php
            
        

    }  // cierre del while y del if
        
        ?>

        </table>
                        
        <?php

        if (mysqli_query($con, $query)) {

        } else {

            echo "<h1>Se ha producido un error en la consulta</h1>";

        }

    $con-->close();

}




// MOSTRAR LAS VIVIENDAS A LOS VIAJEROS

function mostrarViviendasTraveller() {

    include "Model/DDBB/conexion.php";

    $query = "SELECT Name_home, Address, PC, City, Country, Name_img, ID_owner FROM Housing";
    $doQuery = mysqli_query($con, $query);
    
        while ($datos = mysqli_fetch_row($doQuery)) {
            
            ?>
            
            <tr>
            <td><?php echo $datos[0] ?></td>
            <td><?php echo $datos[1] ?></td>
            <td><?php echo $datos[2] ?></td>
            <td><?php echo $datos[3] ?></td>
            <td><?php echo $datos[4] ?></td>
            <td> <img src="View/uploads/<?php echo $datos[5] ?>"></td>
            <td id="reservar">
                <form action="index.php?tr=%207" method="POST">
                    <input type="text" name="name_img" value="<?php echo $datos[5]?>" class="input_form" hidden>
                    <input type="number" name="IDowner" value="<?php echo $datos[6]?>" class="input_form" hidden>
                    <input type="submit" value="Reservar" class="input_form">
                </form>
            </td>
            </tr>
            
            <?php
            if (mysqli_query($con, $query)) {
                
            } else {
    
                echo "<h1>Se ha producido un error en la consulta</h1>";
    
            }
    

        

    }  // cierre del while y del if
        
        ?>

        </table>
                        
        <?php

        
    $con-->close();

}




?>