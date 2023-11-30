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
            <div class="page-title">
                <h1>Users</h1>
            </div>
            <table>
                <thead>
                    <tr>
                        <th width="25%">Name</th>
                        <th width="25%">Username</th>
                        <th width="25%">Type</th>
                        <th width="25%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $sql = "SELECT * FROM users";
                        $result = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($result) > 0) {
                            while($row = mysqli_fetch_assoc($result)) {
                                $db_userId = $row['user_id'];
                                $db_username = $row['username'];
                                $db_usertype = $row['userType'];
                                $db_fname = $row['fname'];
                                $db_mname = $row['mname'];
                                $db_lname = $row['lname'];
                                $db_gender = $row['gender'];
                                $db_fullname = $db_fname." ".$db_mname." ".$db_lname;

                                echo '
                                    <tr>
                                        <td>'.$db_fullname.'</td>
                                        <td>'.$db_username.'</td>
                                        <td>'.$db_usertype.'</td>
                                        <td><a href="edit_user.php?user_id='.$db_userId.'" class="btn btn-primary">Edit</a></td>
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