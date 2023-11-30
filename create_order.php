<?php
    require_once("session.php");
    require_once("../config.php");
    $buyer_id = $_SESSION['user_id'];
    $total_amount = 0;
    $new_quantity = 0;
    $order_id = 0;
    
    if(isset($_POST['checkout_btn'])){
        $contact = $_POST['contact'];
        $address = $_POST['address'];
        $postal = $_POST['postal'];
        $sql = "INSERT INTO orders (buyer_id, total_amount, contact_number, address, postal_code, order_status)
                VALUES ('$buyer_id', '0', '$contact', '$address', '$postal', 0)";
        if (mysqli_query($conn, $sql)) {
            $order_id = mysqli_insert_id($conn);
        }
        $sql = "SELECT c.*, p.product_price, p.product_quantity
                FROM carts c
                INNER JOIN products p ON c.product_id = p.product_id
                WHERE c.buyer_id = '$buyer_id'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                $quantity = $row['quantity'];
                $product_id = $row['product_id'];
                $product_price = $row['product_price'];
                $product_quantity = $row['product_quantity'];
                $new_quantity = $product_quantity - $quantity;

                $total_amount += ($quantity * $product_price);

                $update_qty = "UPDATE products SET product_quantity='$new_quantity' WHERE product_id='$product_id'";

                if (mysqli_query($conn, $update_qty)) {

                    $orderItems_sql = "INSERT INTO order_items (order_id, buyer_id, product_id, quantity)
                            VALUES ('$order_id', '$buyer_id', '$product_id', '$quantity')";
                    if (mysqli_query($conn, $orderItems_sql)) {
                        $new_quantity = 0;
                    }
                }
            }
        }

        $sql = "UPDATE orders SET total_amount='$total_amount' WHERE order_id='$order_id'";

        if (mysqli_query($conn, $sql)) {
            $sql = "DELETE FROM carts WHERE buyer_id='$buyer_id'";

            if (mysqli_query($conn, $sql)) {
                header("Location: index.php");
            }
        }
    }else{
        header("Location: index.php");
    }
?>