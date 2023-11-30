<?php
    session_start();
    require_once("config.php");
    $error = '';

    if(isset($_POST['login_submit'])){
        $username = $_POST['username'];
        $password = $_POST['password'];
        $usertype = $_POST['userType'];

        $sql = "SELECT * FROM users WHERE username='$username'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                $db_password = $row['password'];
                $db_usertype = $row['userType'];
                $db_fname = $row['fname'];
                $db_mname = $row['mname'];
                $db_lname = $row['lname'];
                $db_gender = $row['gender'];
                $db_userId = $row['user_id'];

                if(password_verify($password, $db_password)){
                    if($db_usertype == $usertype){
                        $_SESSION['user_id'] = $db_userId;
                        $_SESSION['userType'] = $db_usertype;
                        $_SESSION['first_name'] = $db_fname;
                        $_SESSION['middle_name'] = $db_mname;
                        $_SESSION['last_name'] = $db_lname;
                        $_SESSION['fullname'] = $db_fname." ".$db_mname." ".$db_lname;
                        $_SESSION['gender'] = $db_gender;
                        $_SESSION['username'] = $username;
                        if($db_usertype == 'Admin'){
                            header("Location: admin/index.php");
                        }elseif ($db_usertype == 'Seller') {
                            header("Location: seller/index.php");
                        }elseif ($db_usertype == 'Buyer') {
                            header("Location: buyer/index.php");
                        }
                    }else{
                        $error = 'User type is incorrect';
                    }
                }else{
                    $error = 'Incorrect Password';
                }
            }
        }else{
            $error = 'Invalid username';
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Kristina Karla L. Andrade | Login</title>
    <link rel="stylesheet" type="text/css" href="style.css"></link>
    <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
</head>
<body>
    <div class="container">
        <div class="content">
            <div class="flex flex-row row-50">
                <div class="site-logo-container">
                    <img src="images/site_logo.png" alt="KK Apparel Logo">
                </div>
                <div class="menu-container">
                    <ul class="menu-header">
                        <li class="menu-item">
                            <a href="index.php" class="menu-link">Home</a>
                        </li>
                        <li class="menu-item">
                            <a href="login.php" class="menu-link">Login</a>
                        </li>
                        <li class="menu-item">
                            <a href="register.php" class="menu-link">Register</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="content">
            <h1 class="heading-title">Products</h1>
            <div class="products-display">
              <?php
                $sql = "SELECT * FROM products ";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) > 0) {
                    while($row = mysqli_fetch_assoc($result)) {
                        $product_id = $row['product_id'];
                        $product_name = $row['product_name'];
                        $product_category = $row['product_category'];
                        $product_price = $row['product_price'];
                        $product_quantity = $row['product_quantity'];
                        $image_url = $row['image_url'];
                        
                        echo '
                          <div class="product-container">
                            <div class="product-image-container">
                              <img src="images/products/'.$image_url.'" class="product-image">
                              <span class="product-category">'.$product_category.'</span>
                            </div>
                            <div class="product-info-container">
                              <h3 class="product-name">'.$product_name.'</h3>
                              <p class="product-info">Price: <span class="product-info-value">'.$product_price.'</span></p>
                              <p class="product-info">Qty: <span class="product-info-value">'.$product_quantity.'</span></p>
                            </div>
                            <div class="product-action-container">
                              <a href="login.php" class="btn btn-primary">View Product</a>
                            </div>
                          </div>
                        ';
                    }
                }
              ?>
            </div>
        </div>
    </div>
</body>
</html>