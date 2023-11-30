<?php
    require_once("session.php");
    require_once("../config.php");
    
    $seller_id = $_SESSION['user_id'];
    $error = '';

    if(isset($_GET['product_id'])){
        $product_id = $_GET['product_id'];

        $sql = "SELECT * FROM products WHERE product_id='$product_id'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            $sql = "DELETE FROM products WHERE product_id='$product_id'";

            if (mysqli_query($conn, $sql)) {
                header("Location: index.php");
            }
        }else{
            header("Location: index.php");
        }
    }else{
        header("Location: index.php");
    }
?>