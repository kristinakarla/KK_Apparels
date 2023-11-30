<?php
    session_start();
    if(!isset($_SESSION['userType']) || !($_SESSION['userType'] == 'Seller')){
        header("Location: ../index.php");
    }
?>