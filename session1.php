<?php
    session_start();
    if(!isset($_SESSION['userType']) || !($_SESSION['userType'] == 'Buyer')){
        header("Location: ../index.php");
    }
?>