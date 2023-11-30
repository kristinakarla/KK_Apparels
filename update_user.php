<?php
    require_once("session.php");
    require_once("../config.php");

    if(isset($_POST['edit_profile'])){
        $fname = ucwords($_POST['first_name']);
        $mname = ucwords($_POST['middle_name']);
        $lname = ucwords($_POST['last_name']);
        $gender = $_POST['gender'];
        $username = $_POST['username'];
        $usertype = $_POST['usertype'];
        $user_id = $_POST['user_id'];

        $sql = "SELECT * FROM users WHERE username='$username' AND user_id!='$user_id'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) == 0) {
            $sql = "UPDATE users SET fname='$fname', mname='$mname', lname='$lname', gender='$gender', username='$username', userType='$usertype' WHERE user_id='$user_id'";

            if (mysqli_query($conn, $sql)) {
                header("Location: index.php");
            }
        }else{
            $_SESSION['error'] = 'Username is already used.';
            header("Location: edit_user.php?user_id=$user_id");
        }

    }else{
        header("Location: index.php");
    }


?>