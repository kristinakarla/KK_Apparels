<?php
    require_once("session.php");
    require_once("../config.php");

    if(isset($_POST['add_category'])){
        $category_name = $_POST['category_name'];

        $sql = "SELECT * FROM product_categories WHERE category_name='$category_name'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) == 0) {
            
            $sql = "INSERT INTO product_categories (category_name, category_status) VALUES ('$category_name', 'Active')";
            if (mysqli_query($conn, $sql)) {
                header("Location: product-categories.php");
            }
        }else{
            $error = 'Category already exists';
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
            <div class="page-title">
                <h1>Add New</h1>
            </div>
            <form action="add_category.php" method="post">
                <div class="form-group">
                    <label for="category_name" class="input-label">Category Name</label>
                    <input type="text" name="category_name" id="category_name" class="input-field" required>
                </div>
                <button type="submit" class="btn btn-primary" name="add_category">Create New Category</button>
            </form>
        </div>
    </div>
</body>
</html>