<?php
    require_once("session.php");
    require_once("../config.php");
    $buyer_id = $_SESSION['user_id'];
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
            <h1 class="heading-title">My Orders</h1>
            <table>
                <thead>
                    <tr>
                        <th width="25%">Order #</th>
                        <th width="25%">Total Amount</th>
                        <th width="25%">Contact Number</th>
                        <th width="25%">Order Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $sql = "SELECT * FROM orders ORDER BY order_status ASC";
                        $result = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($result) > 0) {
                            while($row = mysqli_fetch_assoc($result)) {
                                $total_amount = $row['total_amount'];
                                $contact_number = $row['contact_number'];
                                $order_status = $row['order_status'];
                                $order_id = $row['order_id'];

                                if($order_status == 0){
                                    $status = 'Pending';
                                }elseif($order_status == 1){
                                    $status = 'Confirmed';
                                }elseif ($order_status == 2) {
                                    $status = 'Successful';
                                }elseif ($order_status == 3) {
                                    $stauts = 'Cancelled';
                                }
                                echo '
                                    <tr>
                                        <td>'.$order_id.'</td>
                                        <td>'.$total_amount.'</td>
                                        <td>'.$contact_number.'</td>
                                        <td>'.$status.'</td>
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