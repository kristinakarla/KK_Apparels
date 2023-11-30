<?php
    require_once("config.php");
    $error = '';

    if(isset($_POST['register_submit'])){
        $fname = ucwords($_POST['first_name']);
        $mname = ucwords($_POST['middle_name']);
        $lname = ucwords($_POST['last_name']);
        $gender = $_POST['gender'];
        $username = $_POST['username'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $conf_password = $_POST['conf_password'];

        if($_POST['password'] != ''){
            if(password_verify($conf_password, $password)){
                if($username != ''){
                    $sql = "SELECT * FROM users WHERE username='$username'";
                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) == 0) {
                        if($fname != ''){
                            if($mname != ''){
                                if($lname != ''){
                                    $sql = "INSERT INTO users (fname, mname, lname, gender, username, password, status, userType)
                                    VALUES ('$fname', '$mname', '$lname', '$gender', '$username', '$password', '1', 'Buyer')";
        
                                    if (mysqli_query($conn, $sql)) {
                                        header("Location: login.php");
                                    }
                                }else{
                                    $error = 'Last name is required.';
                                }
                            }else{
                                $error = 'Middle name is required.';
                            }
                        }else{
                            $error = 'First name is required.';
                        }
                    }else{
                        $error = 'Username is already used.';
                    }
                }else{
                    $error = 'Username is required.';
                }
            }else{
                $error = "Password does not match.";
            }
        }else{
            $error = 'Password is required.';
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Kristina Karla L. Andrade | Sign up</title>
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
            <h1 class="heading-title">Sign up</h1>
            <?php echo '<p class="error-message">'.$error.'</p>'; ?>
            <form action="register.php" method="post" class="registration-form">
                <div class="flex flex-row row-33">
                    <div class="form-group">
                        <label for="first_name" class="input-label">First Name</label>
                        <input type="text" name="first_name" id="first_name" class="input-field">
                    </div>
                    <div class="form-group">
                        <label for="middle_name" class="input-label">Middle Name</label>
                        <input type="text" name="middle_name" id="middle_name" class="input-field">
                    </div>
                    <div class="form-group">
                        <label for="last_name" class="input-label">Last Name</label>
                        <input type="text" name="last_name" id="last_name" class="input-field">
                    </div>
                </div>
                <div class="form-group">
                    <label for="gender" class="input-label">Gender</label>
                    <select name="gender" id="gender" class="input-field">
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="username" class="input-label">Username</label>
                    <input type="text" name="username" id="username" class="input-field">
                </div>
                <div class="flex flex-row row-50">
                    <div class="form-group">
                        <label for="password" class="input-label">Password</label>
                        <input type="password" name="password" id="password" class="input-field">
                    </div>
                    <div class="form-group">
                        <label for="conf_password" class="input-label">Confirm Password</label>
                        <input type="password" name="conf_password" id="conf_password" class="input-field">
                    </div>
                </div>
                <button type="submit" name="register_submit" class="registerbtn">Submit</button>
            </form>
        </div>
    </div>
</body>
</html>