<?php

if(isset($_SESSION['traveller'])) {

    unset($_SESSION['traveller']);
    header('Location: index.php');

}

if(isset($_SESSION['owner'])) {

    unset($_SESSION['owner']);
    header('Location: index.php');

}

?>