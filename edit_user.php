<?php
    require_once("session.php");
    require_once("../config.php");
    $error = '';

    if(isset($_GET['user_id'])){
        $user_id = $_GET['user_id'];
        $sql = "SELECT * FROM users WHERE user_id='$user_id'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                $db_username = $row['username'];
                $db_usertype = $row['userType'];
                $db_fname = $row['fname'];
                $db_mname = $row['mname'];
                $db_lname = $row['lname'];
                $db_gender = $row['gender'];
            }
        }else{
            header("Location: index.php");
        }
    }else{
        header("Location: index.php");
    }

    if(isset($_SESSION['error'])){
        $error = $_SESSION['error'];
        unset($_SESSION['error']);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Kristina Karla L. Andrade | Sign up</title>
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
            <h1 class="heading-title">Sign up</h1>
            <?php echo '<p class="error-message">'.$error.'</p>'; ?>
            <form action="update_user.php" method="post" class="update-user-form">
                <input type="hidden" name="user_id" value="<?php echo $user_id ?>" required>
                <div class="flex flex-row row-33">
                    <div class="form-group">
                        <label for="first_name" class="input-label">First Name</label>
                        <input type="text" name="first_name" id="first_name" class="input-field" value="<?php echo $db_fname ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="middle_name" class="input-label">Middle Name</label>
                        <input type="text" name="middle_name" id="middle_name" class="input-field" value="<?php echo $db_mname ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="last_name" class="input-label">Last Name</label>
                        <input type="text" name="last_name" id="last_name" class="input-field" value="<?php echo $db_lname ?>" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="gender" class="input-label">Gender</label>
                    <select name="gender" id="gender" class="input-field" required>
                        <option value="Male" <?php echo ($db_gender=='Male') ? 'selected':''; ?>>Male</option>
                        <option value="Female" <?php echo ($db_gender=='Female') ? 'selected':''; ?>>Female</option>
                    </select>
                </div>
                <div class="flex flex-row row-50">
                    <div class="form-group">
                        <label for="username" class="input-label">Username</label>
                        <input type="text" name="username" id="username" class="input-field" value="<?php echo $db_username ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="usertype" class="input-label">Usertype</label>
                        <select name="usertype" id="usertype" class="input-field" required>
                            <option value="Buyer" <?php echo ($db_usertype=='Buyer') ? 'selected':''; ?>>Buyer</option>
                            <option value="Seller" <?php echo ($db_usertype=='Seller') ? 'selected':''; ?>>Seller</option>
                            <option value="Admin" <?php echo ($db_usertype=='Admin') ? 'selected':''; ?>>Admin</option>
                        </select>
                    </div>
                </div>
                <button type="submit" name="edit_profile" class="registerbtn">Update Profile</button>
            </form>
        </div>
    </div>
</body>
</html>