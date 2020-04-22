<?php
    include 'db_connection.php';
    session_start();
    if(isset($_POST['login'])){
        $username = $_POST['username'];

        $query = "SELECT username, password, role FROM users WHERE username='$username'";
        $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
        if($rowCount = mysqli_num_rows($result)){
            $row = mysqli_fetch_assoc($result);
            $password = $_POST['password'];
            if(password_verify($password, $row['password'])){
                $_SESSION['username'] = $username;
                $_SESSION['role'] = $row['role'];
                header("Location: ../index.php");
            } else {
                header("Location: ../index.php?wrongPass");
            }
        } else {
            header("Location: ../index.php?noUser");
        }


    }

    if(isset($_POST['logout'])){
        session_destroy();
        header("Location: ../index.php");
    }

