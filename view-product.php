<?php
    require_once("session.php");
    require_once("../config.php");

    if(isset($_GET['product_id'])){
        $product_id = $_GET['product_id'];

        $sql = "SELECT * FROM products WHERE product_id='$product_id'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                $product_name = $row['product_name'];
                $product_category = $row['product_category'];
                $product_price = $row['product_price'];
                $product_quantity = $row['product_quantity'];
                $prodct_seller_id = $row['seller_id'];
                $product_image_url = $row['image_url'];
            }
        }else{
            header("Location: index.php");
        }
    }else{
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
                <h1><?php echo $product_name ?></h1>
            </div>
            <div class="flex flex-row row-50 product-info-container">
                <div class="row-left">
                    <div class="product-image-container">
                        <img src="../images/products/<?php echo $product_image_url ?>" class="product-image">
                    </div>
                </div>
                <div class="row-right">
                    <ul class="product-info">
                        <li class="product-info-item">
                            Price
                            <span class="product-info-value">
                                <?php echo $product_price ?>
                            </span>
                        </li>
                        <li class="product-info-item">
                            Category
                            <span class="product-info-value">
                                <?php echo $product_category ?>
                            </span>
                        </li>
                        <li class="product-info-item">
                            Available Quantity
                            <span class="product-info-value">
                                <?php echo $product_quantity ?>
                            </span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            $('#addTocart_form').on('submit', function(e){
                e.preventDefault();
                var formData = $(this).serialize();
                $.ajax({
                    type: 'POST',
                    url: 'add_to_cart.php',
                    data: formData,
                    success: function(response) {
                        var returnedData = JSON.parse(response);
                        alert(returnedData.message)
                    }
                });
            })
        });
    </script>
</body>
</html>