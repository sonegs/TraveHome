<?php

if(isset($_SESSION['traveller'])) {

    unset($_SESSION['traveller']);
    echo "<script>location.href='index.php';</script>";

}

if(isset($_SESSION['owner'])) {

    unset($_SESSION['owner']);
    echo "<script>location.href='index.php';</script>";

}

?>