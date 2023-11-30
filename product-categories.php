<?php
    require_once("session.php");
    require_once("../config.php");
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
                            <a href="products.php" class="menu-link">Products</a>
                        </li>
                        <li class="menu-item">
                            <a href="product-categories.php" class="menu-link">Categories</a>
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
            <div class="flex flex-row row-50">
                <div class="page-title">
                    <h1>Product Categories</h1>
                </div>
                <div class="add-new">
                    <a href="add_category.php" class="btn btn-primary">Add New</a>
                </div>
            </div>
            <table>
                <thead>
                    <tr>
                        <th width="50%">Category Name</th>
                        <th width="50%">No. of Products</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $sql = "SELECT category_name, COUNT(*) as num_products
                        FROM product_categories
                        INNER JOIN products ON product_categories.category_name = products.product_category
                        GROUP BY category_name";
                        $result = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($result) > 0) {
                            while($row = mysqli_fetch_assoc($result)) {
                                $category_id = $row['category_id'];
                                $category_name = $row['category_name'];
                                $num_products = $row['num_products'];

                                echo '
                                    <tr>
                                        <td>'.$category_name.'</td>
                                        <td>'.$num_products.'</td>
                                    </tr>
                                ';
                            }
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>