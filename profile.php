<?php include 'includes/header.php';
    $username = $_SESSION['username'];
?>
<div id="wrapper">
    <div id="page-wrapper">

        <!-- Navigation -->
        <?php include 'includes/navigation.php'; ?>

        <div class="container">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Profile
                        <small><?php echo $_SESSION['username']; ?></small>
                    </h1>

                    <?php
                    $query = "SELECT * FROM users WHERE username='$username'";
                    $result = mysqli_query($connection, $query) or die(mysqli_error($connection));
                    $row = mysqli_fetch_assoc($result);
                    $user_id = $row['user_id'];
                    $firstname = $row['user_firstname'];
                    $lastname = $row['user_lastname'];
                    $photo = $row['user_photo'];
                    $role = $row['role'];
                    $email = $row['email'];
                    ?>

                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" class="form-control" name="username"
                                   style="width: 60vw" value="<?php echo $username; ?>" required>
                        </div>

                        <div class="form-group">
                            <label>Enter a new password</label>
                            <input type="password" class="form-control" name="password" style="width: 60vw" required>
                        </div>

                        <div class="form-group">
                            <label>First Name</label>
                            <input type="text" class="form-control" name="firstname"
                                   style="width: 60vw" value="<?php echo $firstname; ?>" required>
                        </div>

                        <div class="form-group">
                            <label>Last Name</label>
                            <input type="text" class="form-control" name="lastname"
                                   style="width: 60vw" value="<?php echo $lastname; ?>" required>
                        </div>

                        <div class="form-group">
                            <img src="admin/img/<?php echo $photo ?>" alt="" width="100px" required>
                            <input type="file" name="photo">
                        </div>

                        <div class="form-group">
                            <label>Role</label>
                            <input type="text" class="form-control" name="role"
                                   style="width: 60vw" value="<?php echo $role; ?>" readonly>
                        </div>

                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" class="form-control" name="email"
                                   style="width: 60vw" value="<?php echo $email; ?>" required>
                        </div>

                        <div class="form-group">
                            <input type="submit" name="submit" value="Edit Profile" class="btn btn-success">
                        </div>
                    </form>

                    <?php
                    if(isset($_POST['submit'])){
                        $username = $_POST['username'];
                        $_SESSION['username'] = $username;
                        $firstname = $_POST['firstname'];
                        $lastname = $_POST['lastname'];
                        $email = $_POST['email'];
                        $photo = $_FILES['photo']['name'];
                        $photo_tmp = $_FILES['photo']['tmp_name'];
                        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
                        move_uploaded_file($photo_tmp, "admin/img/$photo");

                        $query = "UPDATE users SET username='$username', password='$password', user_firstname='$firstname', 
                                          user_lastname='$lastname', user_photo='$photo', email='$email' WHERE 
                                          user_id=$user_id";
                        mysqli_query($connection, $query) or die(mysqli_error($connection));
                        header("Location: index.php");
                    }
                    ?>
                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->

<!-- jQuery -->
<script src="js/jquery.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>

</body>

</html>