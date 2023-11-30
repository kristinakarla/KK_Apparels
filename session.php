<?php
    session_start();
    if(!isset($_SESSION['userType']) || !($_SESSION['userType'] == 'Admin')){
        header("Location: ../index.php");
    }
?>