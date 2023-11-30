<?php
    require_once("session.php");
    require_once("../config.php");
    $buyer_id = $_SESSION['user_id'];
    $update = false;

    if(isset($_POST['cart_id'])){
        $cart_id = $_POST['cart_id'];
        $qty = $_POST['quantity'];

        $sql = "UPDATE carts SET quantity='$qty' WHERE cart_id='$cart_id'";
        if (mysqli_query($conn, $sql)) {
            $update = true;
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Kristina Karla L. Andrade </title>
    <link rel="stylesheet" type="text/css" href="../style.css"></link>
    <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
</head>
<body>
    <div class="container">
        <div class="content">
            <div class="flex flex-row row-50">
                <div class="site-logo-container">
                    <img src="../images/site_logo.png" alt="KK Apparel Logo">
                </div>
                <div class="menu-container">
                    <ul class="menu-header">
                        <li class="menu-item">
                            <a href="index.php" class="menu-link">Home</a>
                        </li>
                        <li class="menu-item">
                            <a href="cart.php" class="menu-link">My Cart</a>
                        </li>
                        <li class="menu-item">
                            <a href="orders.php" class="menu-link">Orders</a>
                        </li>
                        <li class="menu-item">
                            <a href="logout.php" class="menu-link">Logout</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="content">
            <div class="page-title">
                <h1>My Cart</h1>
            </div>
            <table>
                <thead>
                    <tr>
                        <th width="40%">Product Name</th>
                        <th width="15%">Price</th>
                        <th width="15%">Quantity</th>
                        <th width="15%">Total</th>
                        <th width="15%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $sql = "SELECT * FROM carts WHERE buyer_id='$buyer_id'";
                        $result = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($result) > 0) {
                            while($row = mysqli_fetch_assoc($result)) {
                                $cart_id = $row['cart_id'];
                                $product_id = $row['product_id'];
                                $quantity = $row['quantity'];
                                
                                $sql_product = "SELECT * FROM products WHERE product_id='$product_id'";
                                $result_prdct = mysqli_query($conn, $sql_product);
                                if (mysqli_num_rows($result_prdct) > 0) {
                                    while($row_prdct = mysqli_fetch_assoc($result_prdct)) {
                                        $product_name = $row_prdct['product_name'];
                                        $product_price = $row_prdct['product_price'];
                                        $max_qty = $row_prdct['product_quantity'];
                                    }
                                }

                                $total = $product_price * $quantity;

                                echo '
                                    <tr>
                                        <td>'.$product_name.'</td>
                                        <td>'.$product_price.'</td>
                                        <td>
                                            <form method="POST" action="cart.php">
                                                <input type="number" class="change_qty" name="quantity" min="1" max="'.$max_qty.'" value="'.$quantity.'">
                                                <input type="hidden" name="cart_id" value="'.$cart_id.'">
                                            </form>
                                        </td>
                                        <td>'.$total.'</td>
                                        <td>
                                            <a href="remove_to_cart.php?cart_id='.$cart_id.'" class="btn btn-warning">Remove To Cart</a>
                                        </td>
                                    </tr>
                                ';
                            }
                        }else{
                            echo '
                                <tr>
                                    <td colspan="5">No Products in your cart</td>
                                </tr>
                            ';
                        }
                    ?>
                </tbody>
            </table>
            <?php
                $sql = "SELECT * FROM carts WHERE buyer_id='$buyer_id'";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                    echo '
                        <div class="flex flex-row row-50 cart-btn-container">
                            <div class="row-left"></div>
                            <div class="row-right">
                                    <a href="checkout.php" class="btn btn-primary">Checkout</a>
                            </div>
                        </div>
                    ';
                }
            ?>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            $('.change_qty').change(function() {
                $(this).closest('form').submit();
            });
        });
    </script>
</body>
</html>