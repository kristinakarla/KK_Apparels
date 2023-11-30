<?php
    require_once("session.php");
    require_once("../config.php");
    $seller_id = $_SESSION['user_id'];

    $error = '';

    if(isset($_POST['product_id'])){
        $product_id = $_POST['product_id'];

        $allow = array("jpg", "jpeg", "gif", "png");

        $todir = '../images/products/';

        if ( !!$_FILES['product_image']['tmp_name'] ){
            $info = explode('.', strtolower( $_FILES['product_image']['name']) );

            if ( in_array( end($info), $allow) ){
                if ( move_uploaded_file( $_FILES['product_image']['tmp_name'], $todir . basename($_FILES['product_image']['name'] ) ) ){
                    $image_url = basename($_FILES['product_image']['name']);
                    $sql = "UPDATE products
                            SET 
                                image_url='$image_url'
                            WHERE
                                product_id='$product_id'";
                    if (mysqli_query($conn, $sql)) {
                        header("Location: index.php");
                    }
                }
            }
        }
    }
?>