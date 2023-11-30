<?php
    $host = "localhost";
    $user = "root";
    $pass = "";
    $dbname = "db_kk_apparel";

    $conn = mysqli_connect($host,$user,$pass,$dbname);
   
    if($conn === false){
        die("ERROR: Could not connect. " . mysqli_connect_error());
    }
?>