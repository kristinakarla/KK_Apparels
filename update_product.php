<?php
    require_once("session.php");
    require_once("../config.php");
    $seller_id = $_SESSION['user_id'];

    $error = '';

    if(isset($_POST['edit_product'])){
        $product_id = $_POST['product_id'];
        $product_name = ucwords($_POST['product_name']);
        $product_category = $_POST['product_category'];
        $product_price = $_POST['product_price'];
        $product_quantity = $_POST['product_quantity'];

        $sql = "SELECT * FROM products WHERE product_name='$product_name' AND product_id!='$product_id'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) == 0) {
            $sql = "UPDATE
                products 
            SET 
                product_name='$product_name',
                product_category='$product_category',
                product_price='$product_price', 
                product_quantity='$product_quantity'
            WHERE
                product_id='$product_id'";

            if (mysqli_query($conn, $sql)) {
                header("Location: index.php");
            }
        }else{
            $error = 'Product name already exist';
            $_SESSION['error'] = $error;
        }
        header("Location: index.php");
    }else{
        header("Location: index.php");
    }
?>