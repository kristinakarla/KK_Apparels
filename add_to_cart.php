<?php
    require_once("session.php");
    require_once("../config.php");

    $message = '';
    $buyer_id = $_SESSION['user_id'];

    if(isset($_POST['product_id'])){
        $product_id = $_POST['product_id'];
        $quantity = $_POST['quantity'];

        $sql = "SELECT * FROM products WHERE product_id='$product_id'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            $sql = "SELECT * FROM carts WHERE product_id='$product_id' AND buyer_id='$buyer_id'";
            $result = mysqli_query($conn, $sql);
            if (mysqli_num_rows($result) == 0) {
                $sql = "INSERT INTO carts (buyer_id, product_id, quantity)
                VALUES ('$buyer_id', '$product_id', '$quantity')";
                if (mysqli_query($conn, $sql)) {
                    $message = 'Added to cart';
                }
            }else{
                $message = 'This product is already in the cart';
            }
        }else{
            $message = 'Invalid Product';
        }

        $data = array(
            'message' => $message
        );
    
        echo json_encode($data);
    }else{
        header("Location: index.php");
    }
?>