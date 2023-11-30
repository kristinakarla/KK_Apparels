<?php
    require_once("session.php");
    require_once("../config.php");

    $message = '';
    $buyer_id = $_SESSION['user_id'];

    if(isset($_GET['cart_id'])){
        $cart_id = $_GET['cart_id'];

        $sql = "DELETE FROM carts WHERE cart_id='$cart_id'";

        if (mysqli_query($conn, $sql)) {
            header("Location: cart.php");
        }
    }else{
        header("Location: index.php");
    }
?>