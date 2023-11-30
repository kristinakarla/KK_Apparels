<?php
    require_once("session.php");
    require_once("../config.php");
    $buyer_id = $_SESSION['user_id'];
    $total_amount = 0;
    $numberOf_items = 0;
    
    $sql = "SELECT * FROM carts WHERE buyer_id='$buyer_id'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) == 0) {
        header("Location: index.php");
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
            <h1 class="heading-title">Checkout</h1>
            <div class="flex flex-row row-50">
                <div class="row-left">
                    <div class="checkout-order-container">
                        <table class="checkout">
                            <thead>
                                <tr>
                                    <th>Product Name</th>
                                    <th>Product Price</th>
                                    <th>Quantity</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $sql = "SELECT c.*, p.product_price, p.product_name
                                            FROM carts c
                                            INNER JOIN products p ON c.product_id = p.product_id
                                            WHERE c.buyer_id = '$buyer_id'";
                                    $result = mysqli_query($conn, $sql);
                                    if (mysqli_num_rows($result) > 0) {
                                        $numberOf_items = mysqli_num_rows($result);
                                        while($row = mysqli_fetch_assoc($result)) {
                                            $quantity = $row['quantity'];
                                            $product_id = $row['product_id'];
                                            $product_price = $row['product_price'];
                                            $product_name = $row['product_name'];
                                            $subtotal = $quantity * $product_price;
                            
                                            $total_amount += ($quantity * $product_price);
                                            echo '
                                                <tr>
                                                    <td>'.$product_name.'</td>
                                                    <td>'.$product_price.'</td>
                                                    <td>'.$quantity.'</td>
                                                    <td>'.$subtotal.'</td>
                                                </tr>
                                            ';
                                        }
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row-right">
                    <form action="create_order.php" method="post">
                        <div class="form-group">
                            <label for="contact" class="input-label">Contact Number</label>
                            <input type="text" name="contact" id="contact" class="input-field" required>
                        </div>
                        <div class="form-group">
                            <label for="address" class="input-label">Address</label>
                            <input type="text" name="address" id="address" class="input-field" required>
                        </div>
                        <div class="form-group">
                            <label for="postal" class="input-label">Postal Code</label>
                            <input type="text" name="postal" id="postal" class="input-field" required>
                        </div>
                        <ul class="checkout-info-container">
                            <li>
                                Number of Items:
                                <span class="checkout-data">
                                    <?php echo $numberOf_items ?>
                                </span>
                            </li>
                            <li>
                                Grand Total:
                                <span class="checkout-data">
                                    <?php echo $total_amount ?>
                                </span>
                            </li>
                        </ul>
                        <button type="submit" name="checkout_btn" class="btn btn-primary">Checkout</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>