<?php
    require_once("session.php");
    require_once("../config.php");
    
    $seller_id = $_SESSION['user_id'];
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
                            <a href="add_product.php" class="menu-link">Add Product</a>
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
                <h1>My Products</h1>
            </div>
            <table>
                <thead>
                    <tr>
                        <th width="20%">Product Name</th>
                        <th width="20%">Price</th>
                        <th width="15%">Quantity</th>
                        <th width="20%">Category</th>
                        <th width="25%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $sql = "SELECT * FROM products WHERE seller_id='$seller_id'";
                        $result = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($result) > 0) {
                            while($row = mysqli_fetch_assoc($result)) {
                                $product_id = $row['product_id'];
                                $product_name = $row['product_name'];
                                $product_category = $row['product_category'];
                                $product_price = $row['product_price'];
                                $product_quantity = $row['product_quantity'];

                                echo '
                                    <tr>
                                        <td>'.$product_name.'</td>
                                        <td>'.$product_price.'</td>
                                        <td>'.$product_quantity.'</td>
                                        <td>'.$product_category.'</td>
                                        <td>
                                            <a href="view-product.php?product_id='.$product_id.'" class="btn btn-primary">View</a>
                                            <a href="edit-product.php?product_id='.$product_id.'" class="btn btn-secondary">Edit</a>
                                            <a href="delete-product.php?product_id='.$product_id.'" class="btn btn-warning">Delete</a>
                                        </td>
                                    </tr>
                                ';
                            }
                        }else{
                            echo '
                                <tr>
                                    <td colspan="6">
                                        No products to show <br>
                                        <a href="add_product.php">
                                            Add new product
                                        </a>
                                    </td>
                                </tr>
                            ';
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>