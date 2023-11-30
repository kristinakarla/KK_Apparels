<?php
    require_once("session.php");
    require_once("../config.php");
    $seller_id = $_SESSION['user_id'];

    $error = '';

    if(isset($_POST['product_name'])){
        $product_name = ucwords($_POST['product_name']);
        $product_category = $_POST['product_category'];
        $product_price = $_POST['product_price'];
        $product_quantity = $_POST['product_quantity'];

        $allow = array("jpg", "jpeg", "gif", "png");

        $todir = '../images/products/';

        $sql = "SELECT * FROM products WHERE product_name='$product_name'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) == 0) {
            if ( !!$_FILES['product_image']['tmp_name'] ){
                $info = explode('.', strtolower( $_FILES['product_image']['name']) );
    
                if ( in_array( end($info), $allow) ){
                    if ( move_uploaded_file( $_FILES['product_image']['tmp_name'], $todir . basename($_FILES['product_image']['name'] ) ) ){
                        $image_url = basename($_FILES['product_image']['name']);
                        $sql = "INSERT INTO products
                            (product_name, product_category, product_price, product_quantity, image_url, seller_id, product_status)
                        VALUES
                            ('$product_name', '$product_category', '$product_price', '$product_quantity', '$image_url', '$seller_id', 'Active')";
                        if (mysqli_query($conn, $sql)) {
                            header("Location: index.php");
                        }
                    }
                }
            }
        }else{
            $error = 'Product name already exist';
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
                <h1>Add Product</h1>
            </div>
            <form action="add_product.php" method="post" enctype="multipart/form-data">
                <div class="flex flex-row row-50">
                    <div class="form-group">
                        <label for="product_name" class="input-label">Product Name</label>
                        <input type="text" name="product_name" id="product_name" class="input-field" required>
                    </div>
                    <div class="form-group">
                        <label for="product_category" class="input-label">Product Category</label>
                        <select name="product_category" id="product_category" class="input-field" required>
                            <?php
                                $sql = "SELECT * FROM product_categories";
                                $result = mysqli_query($conn, $sql);
                                if (mysqli_num_rows($result) > 0) {
                                    while($row = mysqli_fetch_assoc($result)) {
                                        $category_id = $row['category_id'];
                                        $category_name = $row['category_name'];

                                        echo '
                                            <option value="'.$category_name.'">'.$category_name.'</option>
                                        ';
                                    }
                                }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="flex flex-row row-33">
                    <div class="form-group">
                        <label for="product_price" class="input-label">Price</label>
                        <input type="number" name="product_price" id="product_price" class="input-field" required>
                    </div>
                    <div class="form-group">
                        <label for="product_quantity" class="input-label">Quantity Available</label>
                        <input type="number" name="product_quantity" id="product_quantity" class="input-field" required>
                    </div>
                    <div class="form-group">
                        <label for="product_image" class="input-label">Product Image</label>
                        <input type="file" name="product_image" accept="image/*" />
                    </div>
                </div>
                <div class="flex flex-row row-50">
                    <div class="left">
                        <p class="error-message"><?php echo $error ?></p>
                    </div>
                    <div class="right">
                        <button type="submit" class="btn btn-primary">Add Product</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</body>
</html>